<template>
    <Head :title="__('Theme')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Theme') }}</span>
                        </div>
                    </div>
                     <div class="card-body">
                        <form @submit.prevent="saveData">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <Label :name="__('Primary Color')" />
                                        <input v-model="form.primary_color" type="color" class="form-control"
                                            id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Hover Color')" />
                                    <input v-model="form.hover_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Secondary Color')" />
                                    <input v-model="form.secondary_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Success Color')" />
                                    <input v-model="form.success_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Info Color')" />
                                    <input v-model="form.info_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Warning Color')" />
                                    <input v-model="form.warning_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <Label :name="__('Danger Color')" />
                                    <input v-model="form.danger_color" type="color" class="form-control"
                                        id="name">
                                        </div>
                                </div>
                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing"/>
                                <span v-else>
                                    <i class="fa-solid fa-sync mr-1"></i>
                                    {{ __('Save') }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
export default {
    props: {
        theme: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                primary_color: this.theme.primary_color,
                hover_color: this.theme.hover_color,
                secondary_color: this.theme.secondary_color,
                success_color: this.theme.success_color,
                info_color: this.theme.info_color,
                warning_color: this.theme.warning_color,
                danger_color: this.theme.danger_color,
            }),

            role: this.$page.props.authenticatedUser.role,
            subscription: this.$page.props.current_subscription,
        };
    },
    methods: {
        async saveData() {
            if (
                this.role == "owner" &&
                this.subscription.plan &&
                this.subscription.plan.plan_features &&
                this.subscription.plan.plan_features.custom_theme_look
            ) {
                this.form.post(route("company.theme.update"), {
                    onSuccess: () => {
                        window.location.reload();
                    },
                });
            } else {
                let response = await axios.get(route("get.translated.text"), {
                    params: {
                        message: "Upgrade your plan to use this feature",
                    },
                });

                this.$toast.error(response.data);
            }
        },
    },
    mounted() {
        this.checkPagePermission("owner");
    },
};
</script>
