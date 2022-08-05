<template>

    <Head :title="__('SEO')" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ __('SEO') }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="customers-table" class="table"
                        role="grid">
                        <thead>
                            <tr role="row">
                                <th width="25%">{{ __('Page Name') }}</th>
                                <th>{{ __('SEO Content') }}</th>
                                <th width="5%">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd" v-for="seo in seo_data" :key="seo.id">
                                <td class="sorting_1">
                                    {{ seo.page_name }}
                                </td>
                                <td>
                                    <div class="mb-2">
                                        <b>{{ __('Meta Title') }}: </b> {{ seo.title }}
                                    </div>
                                    <div class="mb-2">
                                        <b>{{ __('Meta Description') }}: </b> {{ seo.description }}
                                    </div>
                                    <div>
                                        <b>{{ __('Meta Keywords') }}: </b> {{ seo.keywords }}
                                    </div>
                                </td>
                                <td>
                                    <button @click="editContent(seo)" type="button" v-tooltip="__('Edit')" class="btn btn-sm  pl-0">
                                        <EditIcon/>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                   {{ form.page_name }} - {{ __('SEO') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <form @submit.prevent="saveData">
                                    <div class="mb-3 row">
                                        <div class="form-group col-md-12">
                                            <Label :name="__('Title')" for="title"/>
                                            <input v-model="form.title" type="text" class="form-control" :class="{'is-invalid':form.errors.title}" id="title" :placeholder="__('Name')">
                                            <ErrorMessage :name="form.errors.title"/>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <Label :name="__('Keywords')" for="email"/>
                                            <input v-model="form.keywords" type="text" class="form-control" :class="{'is-invalid':form.errors.keywords}" id="title" :placeholder="__('Keywords')">
                                            <ErrorMessage :name="form.errors.keywords"/>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <Label :name="__('Description')" for="email"/>
                                            <textarea v-model="form.description" class="form-control" rows="5" :class="{'is-invalid':form.errors.description}" :placeholder="__('Description')"></textarea>
                                            <ErrorMessage :name="form.errors.description"/>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing" message="Saving..."/>
                                        <span v-else>
                                            <i class="fa-solid fa-check mr-1"></i>
                                            {{ __('Save') }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        layout: "Setting",
        props: {
            seo_data: Array
        },
        data() {
            return {
                showModal: false,
                form: this.$inertia.form({
                    id: '',
                    page_name: '',
                    title: '',
                    description: '',
                    keywords: '',
                })
            }
        },
        methods: {
            editContent(seo) {
                this.form.id = seo.id;
                this.form.page_name = seo.page_name;
                this.form.title = seo.title;
                this.form.description = seo.description;
                this.form.keywords = seo.keywords;
                this.showModal = true;
            },
            saveData(){
                this.form.put(route('settings.seo.update', this.form.id), {
                    onSuccess: () => {
                        this.showModal = false;
                    }
                });
            }
        }
    };
</script>

<style scoped>
.modal-content {
    width: 800px !important;
}
</style>
