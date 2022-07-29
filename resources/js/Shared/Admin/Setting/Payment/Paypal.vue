<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Paypal Live Mode')" />
                    <div>
                         <label class="switch ">
                        <input @change="modeChange" v-model="form.paypal_mode" type="checkbox" class="success toggle-switch" :checked="form.paypal_mode">
                        <span class="slider round"></span>
                    </label>
                    </div>
                </div>
                <template v-if="form.paypal_mode == 1">
                    <div class="form-group">
                        <Label :name="__('Paypal Client ID')" />
                        <input v-model="form.paypal_live_client_id" type="text" class="form-control" :class="{'is-invalid':form.errors.paypal_live_client_id}">
                        <ErrorMessage :name="form.errors.paypal_live_client_id" />
                    </div>
                    <div class="form-group">
                        <Label :name="__('Paypal Secret Key')" />
                        <input v-model="form.paypal_live_client_secret" type="text" class="form-control" :class="{'is-invalid':form.errors.paypal_live_client_secret}">
                        <ErrorMessage :name="form.errors.paypal_live_client_secret" />
                    </div>
                </template>
                <template v-else>
                    <div class="form-group">
                        <Label :name="__('Paypal Client Id')" />
                        <input v-model="form.paypal_sandbox_client_id" type="text" class="form-control" :class="{'is-invalid':form.errors.paypal_sandbox_client_id}">
                        <ErrorMessage :name="form.errors.paypal_sandbox_client_id" />
                    </div>
                    <div class="form-group">
                        <Label :name="__('Paypal Secret Key')" />
                        <input v-model="form.paypal_sandbox_client_secret" type="text" class="form-control" :class="{'is-invalid':form.errors.paypal_sandbox_client_secret}">
                        <ErrorMessage :name="form.errors.paypal_sandbox_client_secret" />
                    </div>
                </template>
                 <div class="form-group">
                    <Label :name="__('Paypal Status')" />
                    <div>
                         <label class="switch ">
                        <input @change="statusChange" v-model="form.paypal_active" type="checkbox" class="success toggle-switch" :checked="form.paypal_active">
                        <span class="slider round"></span>
                    </label>
                    </div>
                </div>
                 <button :disabled="form.processing" type="submit" class="btn btn-primary">
                    <Loading v-if="form.processing" message="Saving..."/>
                    <span v-else>
                        <i class="fa-solid fa-check mr-1"></i>
                        {{ __('Save') }}
                    </span>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                paypal_live_client_id: this.data.paypal_live_client_id,
                paypal_live_client_secret: this.data.paypal_live_client_secret,
                paypal_sandbox_client_id: this.data.paypal_sandbox_client_id,
                paypal_sandbox_client_secret:
                    this.data.paypal_sandbox_client_secret,
                paypal_active: this.data.paypal_active ? 1 : 0,
                paypal_mode: this.data.paypal_mode == "live" ? 1 : 0,
                provider: "paypal",
            }),
        };
    },
    methods: {
        modeChange(event) {
            if (event.target.checked == true) {
                this.form.paypal_mode = 1;
            } else {
                this.form.paypal_mode = 0;
            }
        },
        statusChange(event) {
            if (event.target.checked == true) {
                this.form.paypal_active = 1;
            } else {
                this.form.paypal_active = 0;
            }
        },
        updateData() {
            this.form.put(route("settings.payment.update"));
        },
    },
    watch: {
        data: {
            handler() {
                this.form.paypal_live_client_id =
                    this.data.paypal_live_client_id;
                this.form.paypal_live_client_secret =
                    this.data.paypal_live_client_secret;
                this.form.paypal_sandbox_client_id =
                    this.data.paypal_sandbox_client_id;
                this.form.paypal_sandbox_client_secret =
                    this.data.paypal_sandbox_client_secret;
                this.form.paypal_active = this.data.paypal_active ? 1 : 0;
                this.form.paypal_mode = this.data.paypal_mode == "live" ? 1 : 0;
            },
            deep: true,
        },
    },
};
</script>

<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 35px;
        height: 19px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 3px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.success:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(15px);
        -ms-transform: translateX(15px);
        transform: translateX(15px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
