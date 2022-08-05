<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Banner Title')" />
                    <input v-model="form.home_banner_title" type="text" class="form-control" :class="{'is-invalid':form.errors.home_banner_title}">
                    <ErrorMessage :name="form.errors.home_banner_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('Banner Description')" />
                    <textarea v-model="form.home_banner_description" class="form-control" :class="{'is-invalid':form.errors.home_banner_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.home_banner_description" />
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <Label :name="__('Banner Button Text')" />
                        <input v-model="form.home_banner_button_text" type="text" class="form-control" :class="{'is-invalid':form.errors.home_banner_button_text}">
                        <ErrorMessage :name="form.errors.home_banner_button_text" />
                    </div>
                    <div class="col-md-6">
                        <Label :name="__('Banner Button Url')" />
                        <input v-model="form.home_banner_button_url" type="text" class="form-control" :class="{'is-invalid':form.errors.home_banner_button_url}">
                        <ErrorMessage :name="form.errors.home_banner_button_url" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <Label :name="__('Banner Button 2 Text')" />
                        <input v-model="form.home_banner_button2_text" type="text" class="form-control" :class="{'is-invalid':form.errors.home_banner_button2_text}">
                        <ErrorMessage :name="form.errors.home_banner_button2_text" />
                    </div>
                    <div class="col-md-6">
                        <Label :name="__('Banner Button 2 Url')" />
                        <input v-model="form.home_banner_button2_url" type="text" class="form-control" :class="{'is-invalid':form.errors.home_banner_button2_url}">
                        <ErrorMessage :name="form.errors.home_banner_button2_url" />
                    </div>
                </div>
                 <div class="form-group">
                    <Label :name="__('Feature Title')" />
                    <input v-model="form.home_feature_title" type="text" class="form-control" :class="{'is-invalid':form.errors.home_feature_title}">
                    <ErrorMessage :name="form.errors.home_feature_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('Feature Subtitle')" />
                    <input v-model="form.home_feature_subtitle" type="text" class="form-control" :class="{'is-invalid':form.errors.home_feature_subtitle}">
                    <ErrorMessage :name="form.errors.home_feature_subtitle" />
                </div>
                <div class="form-group">
                    <Label :name="__('Feature Description')" />
                    <textarea v-model="form.home_feature_description" class="form-control" :class="{'is-invalid':form.errors.home_feature_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.home_feature_description" />
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
        cms: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                home_banner_title: this.cms.home_banner_title,
                home_banner_description: this.cms.home_banner_description,
                home_banner_button_text: this.cms.home_banner_button_text,
                home_banner_button2_text: this.cms.home_banner_button2_text,
                home_banner_button_url: this.cms.home_banner_button_url,
                home_banner_button2_url: this.cms.home_banner_button2_url,
                home_feature_title: this.cms.home_feature_title,
                home_feature_subtitle: this.cms.home_feature_subtitle,
                home_feature_description: this.cms.home_feature_description,
                type: 'home',
            }),
        };
    },
    methods: {
        updateData() {
            this.form.put(route("settings.cms.update"));
        },
    },
    watch: {
        data: {
            handler() {
                this.form.home_banner_title = this.data.home_banner_title;
                this.form.home_banner_description = this.data.home_banner_description;
                this.form.home_banner_button_text = this.data.home_banner_button_text;
                this.form.home_banner_button2_text = this.data.home_banner_button2_text;
                this.form.home_banner_button_url = this.data.home_banner_button_url;
                this.form.home_banner_button2_url = this.data.home_banner_button2_url;
                this.form.home_feature_title = this.data.home_feature_title;
                this.form.home_feature_subtitle = this.data.home_feature_subtitle;
                this.form.home_feature_description = this.data.home_feature_description;
            },
            deep: true,
        },
    },
};
</script>
