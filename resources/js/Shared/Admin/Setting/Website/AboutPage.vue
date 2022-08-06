<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('About Title')" />
                    <input v-model="form.about_title" type="text" class="form-control" :class="{'is-invalid':form.errors.about_title}">
                    <ErrorMessage :name="form.errors.about_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('About Subtitle')" />
                    <input v-model="form.about_subtitle" type="text" class="form-control" :class="{'is-invalid':form.errors.about_subtitle}">
                    <ErrorMessage :name="form.errors.about_subtitle" />
                </div>
                <div class="form-group ">
                    <Label :name="__('About Description')" />
                      <QuillEditor theme="snow" v-model:content="form.about_description" contentType="html" class="h-250"/>
                    <ErrorMessage :name="form.errors.about_description" />

                </div>
                 <div class="form-group mb-3 row">
                    <div class="col-md-6">
                        <Label :name="__('About Image')" :required="false"/> <br>
                        <input accept="image/jpeg, image/jpg/ image/png, image/svg" type="file" @change="onImageChange"
                            :class="{'is-invalid':form.errors.about_image}">
                        <ErrorMessage :name="form.errors.about_image" />
                    </div>
                    <div class="col-md-6">
                        <Label :name="__('Preview')" :required="false" /> <br>
                        <img :src="about_image_preview" alt="logo" height="200" width="200" class="object-cover-fit rounded">
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
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    props: {
        cms: Object,
    },
     components: {
        QuillEditor
    },
    data() {
        return {
            form: this.$inertia.form({
                about_title: this.cms.about_title,
                about_subtitle: this.cms.about_subtitle,
                about_description: this.cms.about_description,
                about_image: '',
                type: 'about',
                _method: 'PUT',
            }),

            about_image_preview: this.cms.about_image,
        };
    },
    methods: {
        updateData() {
            this.form.post(route("settings.cms.update"));
        },
        onImageChange(e) {
            const file = e.target.files[0];
            this.about_image_preview = URL.createObjectURL(file);
            this.form.about_image = file;
        }
    },
    watch: {
        data: {
            handler() {
                this.form.about_title = this.cms.about_title;
                this.form.about_subtitle = this.cms.about_subtitle;
                this.form.about_description = this.cms.about_description;
                this.about_image_preview = this.cms.about_image;
            },
            deep: true,
        },
    },
};
</script>


<style scoped>
.object-cover-fit {
    object-fit: cover;
}
</style>
