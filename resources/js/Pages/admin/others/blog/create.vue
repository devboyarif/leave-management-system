<template>
    <Head :title="__('Post Create')"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Post Create') }}</h3>
                        <Link :href="route('posts.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-8">
                        <form @submit.prevent="createData">
                        <div class="mb-3 row">
                           <div class="col-md-6">
                                <Label :name="__('Name')"/>
                                <input v-model="form.title" type="text" class="form-control" :class="{'is-invalid':form.errors.title}" id="name">
                                <ErrorMessage :name="form.errors.title"/>
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Thumbnail')" :required="false"/>
                                <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.thumbnail = $event.target.files[0]" :class="{'is-invalid':form.errors.thumbnail}"/>
                                <ErrorMessage :name="form.errors.thumbnail"/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Short Description')" />
                            <textarea class="form-control" v-model="form.short_description" :class="{'is-invalid':form.errors.short_description}" rows="5"></textarea>
                            <ErrorMessage :name="form.errors.short_description" />
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Long Description')" />
                             <QuillEditor theme="snow" v-model:content="form.long_description" contentType="html" class="h-250"/>
                            <ErrorMessage :name="form.errors.long_description" />
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
            </div>
        </div>
    </div>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
     components: {
        QuillEditor
    },
    data() {
        return {
            form: this.$inertia.form({
                title: "",
                thumbnail: "",
                short_description: "",
                long_description: "",
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("posts.store"), {
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>
