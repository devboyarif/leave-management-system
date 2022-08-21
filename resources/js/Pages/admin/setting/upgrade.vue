<template>
    <Head :title="__('Upgrade')"/>

    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Upgrade') }}</h3>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateData">
                        <div class="d-flex justify-content-center my-3">
                            <div class="form-groups">
                                <input accept=".zip" @input="form.upgrade_zip = $event.target.files[0]" type="file" class="form-control border-0" :class="{'is-invalid':form.errors.upgrade_zip}">
                                <ErrorMessage :name="form.errors.upgrade_zip" />
                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary mb-2">
                                <Loading v-if="form.processing" message="Upgrading..." />
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    {{ __('Upgrade Now') }}
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
    data() {
        return {
            form: this.$inertia.form({
                upgrade_zip: "",
            }),
        };
    },
    methods: {
        updateData() {
            this.form.post(route("settings.upgrade.system"));
        },
    },
};
</script>

