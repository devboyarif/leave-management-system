<template>
    <Head :title="__('SMTP')"/>

    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">{{ __('Mail Settings') }}</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="saveSetting">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Driver')" />
                                    <input disabled type="text" class="form-control " id="driver" value="smtp"
                                        name="driver">
                                </div>
                             </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Host')" />
                                    <input v-model="form.host" type="text" class="form-control" :class="{'is-invalid':form.errors.host}">
                                    <ErrorMessage :name="form.errors.host" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Port')"/>
                                    <select v-model="form.port" class="form-control" :class="{'is-invalid':form.errors.port}">
                                        <option value="587">587</option>
                                        <option value="465">465</option>
                                        <option value="25">25</option>
                                        <option value="2525">2525</option>
                                    </select>
                                    <ErrorMessage :name="form.errors.port" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Username')" />
                                    <input v-model="form.username" type="text" class="form-control" :class="{'is-invalid':form.errors.username}">
                                    <ErrorMessage :name="form.errors.username" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Password')" />
                                    <input v-model="form.password" type="text" class="form-control" :class="{'is-invalid':form.errors.password}">
                                    <ErrorMessage :name="form.errors.password" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail Encryption')" />
                                    <select v-model="form.encryption" class="form-control" :class="{'is-invalid':form.errors.encryption}">
                                        <option value="tls">TLS</option>
                                        <option value="ssl">SSL</option>
                                    </select>
                                    <ErrorMessage :name="form.errors.encryption" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail From Address')" />
                                    <input v-model="form.from_address" type="email" class="form-control" :class="{'is-invalid':form.errors.from_address}">
                                    <ErrorMessage :name="form.errors.from_address" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <Label :name="__('Mail From Name')" />
                                    <input v-model="form.from_name" type="text" class="form-control" :class="{'is-invalid':form.errors.from_name}">
                                    <ErrorMessage :name="form.errors.from_name" />
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto">
                            <div class="text-center">
                                <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                    <Loading v-if="form.processing" message="Saving..." />
                                    <span v-else>
                                        <i class="fa-solid fa-check mr-1"></i>
                                        {{ __('Save') }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Send Test Mail') }}</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="testMailSend">
                        <div class="d-flex justify-content-center">
                            <div class="form-group mx-sm-3 mb-2">
                                    <input v-model="testMailForm.email" type="email" class="form-control mail-address-width" :class="{'is-invalid':testMailForm.errors.email}">
                                    <ErrorMessage :name="testMailForm.errors.email" />
                                </div>

                                <button @click="testMailSend" :disabled="testMailForm.processing" type="submit" class="btn btn-primary mb-2">
                                    <Loading v-if="testMailForm.processing" message="Sending..." />
                                    <span v-else>
                                        <i class="fa-solid fa-check mr-1"></i>
                                        {{ __('Send Email') }}
                                    </span>
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: "Setting",
    props: {
        data: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                type: this.data.type,
                host: this.data.host,
                port: this.data.port,
                password: this.data.password,
                username: this.data.username,
                encryption: this.data.encryption,
                from_name: this.data.from_name,
                from_address: this.data.from_address,
            }),

            testMailForm: this.$inertia.form({
                email: "",
            }),
        };
    },
    methods: {
        saveSetting() {
            this.form.put(route("settings.smtp.update"));
        },
        testMailSend() {
            this.testMailForm.post(route("settings.send.test.email"), {
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },
};
</script>

<style scoped>
    .mail-address-width {
        min-width: 400px;
    }
</style>
