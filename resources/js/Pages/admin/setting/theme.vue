<template>
    <Head :title="__('Theme')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>{{ __('Admin Theme') }}</span>
                    </div>
                </div>
                    <div class="card-body">
                    <form @submit.prevent="saveData('admin')">
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
                        <div class="row justify-content-center mt-5">
                                <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-sync mr-1"></i>
                                {{ __('Save') }}
                            </span>
                        </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>{{ __('Website Theme') }}</span>
                    </div>
                </div>
                    <div class="card-body">
                    <form @submit.prevent="saveData('website')">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <Label :name="__('Primary Color')" />
                                    <input v-model="websiteForm.website_primary_color" type="color" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <Label :name="__('Secondary Color')" />
                                <input v-model="websiteForm.website_secondary_color" type="color" class="form-control"
                                    id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <Label :name="__('Body Text Color')" />
                                    <input v-model="websiteForm.website_body_text_color" type="color" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <Label :name="__('Body Heading Color')" />
                                <input v-model="websiteForm.website_heading_text_color" type="color" class="form-control"
                                    id="name">
                                    </div>
                            </div>

                        </div>
                        <div class="row justify-content-center mt-5">
                                <button :disabled="websiteForm.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="websiteForm.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-sync mr-1"></i>
                                {{ __('Save') }}
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

            websiteForm: this.$inertia.form({
                website_primary_color: this.theme.website_primary_color,
                website_secondary_color: this.theme.website_secondary_color,
                website_heading_text_color:
                    this.theme.website_heading_text_color,
                website_body_text_color: this.theme.website_body_text_color,
            }),
        };
    },
    methods: {
        saveData(type) {
            if (type == "admin") {
                this.form.post(route("theme.admin.update"), {
                    onSuccess: () => {
                        window.location.reload();
                    },
                });
            } else {
                this.websiteForm.post(route("theme.website.update"), {
                    onSuccess: () => {
                        window.location.reload();
                    },
                });
            }
        },
    },
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>

<!--
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
</style> -->
