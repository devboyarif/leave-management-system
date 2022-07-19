<template>
    <div v-if="show">
        <transition name="fade">
            <div class="modal-mask" >
                <div class="modal-wrapper" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="hideModalOutsideClick">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Invite Employee') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="hideModal()">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="sendData">
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label name="Email" />
                                            <input v-model="form.email" type="email" autocomplete="off" class="form-control"
                                                :class="{'is-invalid':form.errors.email}" id="name">
                                            <ErrorMessage :name="form.errors.email" />
                                        </div>
                                        <div class="col-md-12 my-1">
                                            <Label name="Team" />
                                        <select class="form-control" v-model="form.team_id"
                                            :class="{'is-invalid':form.errors.team_id}">
                                            <option value="" class="d-none">{{ __('Select Team') }}</option>
                                            <option v-for="team in teams" :key="team.id" :value="team.id">
                                                {{ team.name }}
                                            </option>
                                        </select>
                                        <ErrorMessage :name="form.errors.team_id" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="hideModal()">{{ __('Close') }}</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing" message="Inviting..."/>
                                        <span v-else>
                                            <i class="fa-regular fa-paper-plane"></i>
                                            {{ __('Invite') }}
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
        teams: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                email: "",
                team_id: "",
            }),

            teams: this.teams,
        };
    },

    methods: {
        hideModal() {
            this.$emit("close");
        },
        sendData() {
            // console.log(this.form);
            this.form.post(route("company.invite.send"), {
                onSuccess: () => {
                    this.form.reset();
                    this.hideModal();
                },
            });
            // this.form.post(route("company.employees.invite"), {
            //     onSuccess: () => {
            //         this.form.reset();
            //         this.hideModal();
            //     },
            // });
        },
        hideModalOutsideClick() {
            if (this.form.processing) {
                return;
            } else {
                this.$emit("close");
            }
        },
    },
};
</script>

