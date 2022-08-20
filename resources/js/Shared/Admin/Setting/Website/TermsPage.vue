<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Terms Content')" />
                     <QuillEditor theme="snow" v-model:content="form.terms_description" contentType="html" class="h-250"/>
                    <ErrorMessage :name="form.errors.terms_description" />
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
                terms_description: this.cms.terms_description,
                type: 'terms',
            }),
        };
    },
    methods: {
        updateData() {
            this.form.put(route("settings.cms.update"));
        }
    },
    watch: {
        data: {
            handler() {
                this.form.terms_description = this.cms.terms_description;
            },
            deep: true,
        },
    },
};
</script>
