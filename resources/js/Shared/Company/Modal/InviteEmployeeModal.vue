<template>
    <div v-if="show">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Invite Employee
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="hideModal()">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label name="Email" />
                                            <input v-model="form.email" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.email}" id="name">
                                            <ErrorMessage :name="form.errors.email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="hideModal()">Close</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing" />
                                        <span v-else>
                                            <i class="fa-solid fa-check mr-1"></i>
                                            Save
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
        show: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                email: "",
                teams: [],
            }),
        };
    },

    methods: {
        hideModal() {
            this.$emit("close");
        },
    },
};
</script>

