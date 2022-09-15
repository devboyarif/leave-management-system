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
                                    <div class="mb-3 row justify-content-center" v-for="(email, index) in form.emails"
                                        :key="index">
                                        <div class="col-lg-5">
                                            <input v-model="form.emails[index]" class="form-control" :class="{'border-danger':form.errors.emails}" type="email" :placeholder="__('Employee Email')">
                                            <ErrorMessage :name="form.errors.emails" />
                                        </div>
                                        <div class="col-lg-5">
                                            <select class="form-control" v-model="form.teams[index]" :class="{'border-danger':form.errors.teams}">
                                                <option value="" class="d-none">{{ __('Select Team') }}</option>
                                                <option :value="team.id" v-for="team in teams" :key="team.id">{{ team.name }}</option>
                                            </select>
                                            <ErrorMessage :name="form.errors.teams" />
                                        </div>
                                        <div class="col-lg-1" v-if="index == 0">
                                            <button type="button" class="btn btn-primary mt-0" @click="addMore">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-1" v-else>
                                            <button type="button" class="btn btn-danger mt-0" @click="removeField(index)">
                                                <i class="fas fa-times"></i>
                                            </button>
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
                emails: [""],
                teams: [""],
            }),

            teams: this.teams,
        };
    },

    methods: {
        addMore() {
            this.form.emails.push("");
            this.form.teams.push("");
        },
        removeField(index) {
            this.form.emails.splice(index, 1);
            this.form.teams.splice(index, 1);
        },
        hideModal() {
            this.$emit("close");
        },
        sendData() {
            this.form.post(route("company.invite.send"), {
                onSuccess: () => {
                    this.form.reset();
                    this.hideModal();
                },
            });
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

<style scoped>
.modal-content {
    width: 750px !important;
}
</style>
