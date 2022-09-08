<template>
    <Head :title="__('Faq List')" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Faq List') }}</h3>
                        <button @click="showModal = true" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
                <div class="card-body" v-if="faqs && faqs.length">
                    <SingleAccordian v-for="faq in faqs" :key="faq.id" :faq="faq" @edit="editData"/>
                </div>
                <div class="card-body text-center" v-else>
                    <h6>{{ __('No Data Found') }}</h6>
                </div>
            </div>
        </div>
   </div>

      <!-- Create or Edit Faq Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <span v-if="!editMode">{{ __('Create Faq') }}</span>
                                    <span v-else>{{ __('Edit Faq') }}</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <Label :name="__('Question')" />
                                            <input v-model="form.question" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.question}" id="name">
                                            <ErrorMessage :name="form.errors.question" />
                                        </div>
                                        <div class="col-md-12">
                                            <Label :name="__('Answer')" />
                                            <textarea rows="10" v-model="form.answer" class="form-control"
                                                :class="{'is-invalid':form.errors.answer}" ></textarea>
                                            <ErrorMessage :name="form.errors.answer" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="showModal = false">{{ __('Close') }}</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing" />
                                        <span v-else>
                                            <i class="fa-solid fa-check mr-1"></i>
                                            {{ __('Save') }}
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import SingleAccordian from "../../../Shared/Admin/Faq/SingleAccordian.vue";

export default {
    components: {
        SingleAccordian,
    },
    props: {
        faqs: {
            type: Array,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                question: "",
                answer: "",
            }),

            editMode: false,
            showModal: false,
            faq_id: null,
        };
    },
    methods: {
        saveData() {
            if (!this.editMode) {
                this.form.post(
                    route("faqs.store"),
                    {
                        onSuccess: () => {
                            this.showModal = false;
                            this.form.reset();
                        },
                    },
                    {
                        preserveScroll: true,
                        preserveState: true,
                    }
                );
            } else {
                this.form.put(
                    route("faqs.update", this.faq_id),
                    {
                        onSuccess: () => {
                            this.showModal = false;
                            this.form.reset();
                        },
                    },
                    {
                        preserveScroll: false,
                        preserveState: true,
                    }
                );
            }
        },
        editData(faq) {
            this.form.clearErrors();
            this.editMode = true;
            this.form.reset();
            this.faq_id = faq.id;
            this.form.question = faq.question;
            this.form.answer = faq.answer;
            this.showModal = true;
        },
    },
};
</script>

<style scoped>
.modal-content {
    width: 700px !important;
}
</style>
