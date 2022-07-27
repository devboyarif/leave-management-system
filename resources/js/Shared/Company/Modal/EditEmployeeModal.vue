<template>
    <div v-if="show">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="hideModalOutsideClick">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Edit Employee
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="hideModal()">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <Label name="Name" />
                                            <input v-model="form.name" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.name}" id="name">
                                            <ErrorMessage :name="form.errors.name" />
                                        </div>
                                        <div class="col-md-6">
                                            <Label name="Email address" />
                                            <input v-model="form.email" type="email" class="form-control"
                                                :class="{'is-invalid':form.errors.email}" id="email">
                                            <ErrorMessage :name="form.errors.email" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <Label name="Team" />
                                        <select class="form-control" v-model="form.team_id"
                                            :class="{'is-invalid':form.errors.team_id}">
                                            <option value="" class="d-none">Select Team</option>
                                            <option v-for="team in teams" :key="team.id" :value="team.id">
                                                {{ team.name }}
                                            </option>
                                        </select>
                                        <ErrorMessage :name="form.errors.team_id" />
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-lg-6">
                                            <Label name="Change Password" />
                                            <input v-model="form.password" type="password" class="form-control"
                                                :class="{'is-invalid':form.errors.password}" id="password">
                                            <ErrorMessage :name="form.errors.password" />
                                        </div>
                                        <div class="col-lg-6">
                                            <Label name="Confirm Password" />
                                            <input v-model="form.password_confirmation" type="password"
                                                class="form-control"
                                                :class="{'is-invalid':form.errors.password_confirmation}"
                                                id="password_confirmation">
                                            <ErrorMessage :name="form.errors.password_confirmation" />
                                        </div>
                                    </div>
                                     <div class="mb-3 row">
                                        <div class="col-lg-6">
                                            <Label :name="__('Phone Number')"/>
                                            <vue-tel-input v-model="form.phone" mode="international"/>
                                        </div>
                                       <div class="col-md-6">
                                            <Label name="Change Avatar" :required="false" />
                                            <input accept="image/jpeg, image/jpg/ image/png"
                                                class="form-control border-0 p-0" type="file"
                                                @input="form.avatar = $event.target.files[0]"
                                                :class="{'is-invalid':form.errors.avatar}" />
                                            <ErrorMessage :name="form.errors.avatar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="hideModal()">
                                        Close
                                    </button>
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
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

export default {
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        employee: {
            type: Object,
            default: {},
        },
        teams: {
            type: Array,
            default: () => [],
        },
    },
     components: {
        VueTelInput,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.employee.user.name,
                email: this.employee.user.email,
                password: null,
                password_confirmation: null,
                avatar: null,
                team_id: this.employee.team_id,
                _method: "PUT",
                phone: this.employee.phone,
            }),

            teams: this.teams,
        };
    },

    methods: {
        hideModal() {
            this.$emit("close");
        },
        hideModalOutsideClick() {
            if (this.form.processing) {
                return;
            }else{
                this.$emit("close");
            }
        },
        saveData() {
            this.form.post(
                route("company.employees.update", this.employee.id),
                {
                    onSuccess: () => {
                        this.$emit("updated");
                        this.form.reset();
                        this.hideModal();
                    },
                }
            );
        },
    },
};
</script>

<style scoped>
    .modal-dialog {
        max-width: 600px !important;
    }
</style>
