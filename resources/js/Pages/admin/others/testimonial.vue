<template>
 <Head :title="__('Testimonial List')" />

    <div class="text-right py-3">
        <button @click="showModal = true" class="btn btn-primary"><i class="fas fa-plus"></i>
            {{ __('Create') }}
        </button>
    </div>
    <div class="row mt-3" v-if="testimonials && testimonials.length">
        <div class="col-md-3" v-for="testimonial in testimonials" :key="testimonial.id">
            <div class="card text-center">
                <img :src="testimonial.avatar" class="card-img-top"
                    alt="user image">
                <div class="card-body">
                    <h4>{{ testimonial.name }}</h4>
                    <h6 class="badge badge-primary">{{ testimonial.position }}</h6>
                    <p class="card-text">{{ testimonial.description }}</p>
                    <div class="mx-auto justify-content-center align-items-center">
                        <button v-tooltip="__('Edit')" class="btn btn-sm" @click="editData(testimonial)">
                            <EditIcon/>
                        </button>
                        <button v-tooltip="__('Delete')" class="btn btn-sm" @click="deleteData(testimonial.id)">
                            <DeleteIcon/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center text-center" v-else>
        <h4>{{ __('No Data Found') }}</h4>
    </div>

    <!-- Create or Edit Testimonial Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <span v-if="!editMode">{{ __('Create Testimonial') }}</span>
                                    <span v-else>{{ __('Edit Testimonial') }}</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>

                            {{ form.name }}
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <Label :name="__('Name')" />
                                            <input v-model="form.name" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.name}" id="name">
                                            <ErrorMessage :name="form.errors.name" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <Label :name="__('Position')" />
                                            <input v-model="form.position" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.position}" id="name">
                                            <ErrorMessage :name="form.errors.position" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <Label :name="__('Description')" />
                                            <textarea rows="5" v-model="form.description" class="form-control"
                                                :class="{'is-invalid':form.errors.description}" ></textarea>
                                            <ErrorMessage :name="form.errors.description" />
                                        </div>
                                        <div class="col-lg-6">
                                            <Label :name="__('Avatar')" v-if="!editMode"/>
                                            <Label :name="__('Change Avatar')" v-else :required="false"/>
                                            <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.avatar = $event.target.files[0]" :class="{'is-invalid':form.errors.avatar}"/>
                                            <ErrorMessage :name="form.errors.avatar"/>
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
export default {
    props: {
        testimonials: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                position: "",
                description: "",
                avatar: "",
                _method: "POST",
            }),

            editMode: false,
            showModal: false,
            testimonial_id: null,
        };
    },

    methods: {
        saveData() {
            if (!this.editMode) {
                this.form._method = "POST";
                this.form.post(
                    route("testimonials.store"),
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
                this.form._method = "PUT";
                this.form.post(
                    route("testimonials.update", this.testimonial_id),
                    {
                        onSuccess: () => {
                            this.showModal = false;
                            this.form.reset();
                        },
                    }
                );
            }
        },
        deleteData(testimonial_id) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(
                        route("testimonials.destroy", testimonial_id)
                    );
                }
            });
        },
        editData(testimonial) {
            this.form.clearErrors();
            this.editMode = true;
            this.form.reset();
            this.testimonial_id = testimonial.id;
            this.form.name = testimonial.name;
            this.form.position = testimonial.position;
            this.form.description = testimonial.description;
            this.form.answer = testimonial.answer;
            this.showModal = true;
        },
    },
};
</script>

<style scoped>
.card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 20px auto 0;
}
</style>
