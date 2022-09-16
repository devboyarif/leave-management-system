<template>
    <div class="card">
        <div class="card-body">
            <h6>{{ __('Working Days') }}</h6>
            <hr>
            <form @submit.prevent="saveData">
                <div class="d-flex flex-wrap flex-column">
                    <div class="d-flex flex-wrap row">
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.sunday" :checked="form.sunday" type="checkbox">
                                {{ __('Sunday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.monday" :checked="form.monday" type="checkbox">
                                {{ __('Monday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.tuesday" :checked="form.tuesday" type="checkbox">
                                {{ __('Tuesday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.wednesday" :checked="form.wednesday" type="checkbox">
                                {{ __('Wednesday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.thursday" :checked="form.thursday" type="checkbox">
                                {{ __('Thursday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.friday" :checked="form.friday" type="checkbox">
                                {{ __('Friday') }}
                            </label>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label>
                                <input v-model="form.saturday" :checked="form.saturday" type="checkbox">
                                {{ __('Saturday') }}
                            </label>
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing" />
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                {{ __('Save') }}
                            </span>
                        </button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        workingdays: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                sunday: this.workingdays.sunday ? true : false,
                monday: this.workingdays.monday ? true : false,
                tuesday: this.workingdays.tuesday ? true : false,
                wednesday: this.workingdays.wednesday ? true : false,
                thursday: this.workingdays.thursday ? true : false,
                friday: this.workingdays.friday ? true : false,
                saturday: this.workingdays.saturday ? true : false,
            }),
        };
    },
    methods: {
        saveData() {
            this.form.put(route("company.workingdays.update"));
        },
    },
    watch: {
        workingdays: {
            handler() {
                this.form.monday = this.workingdays.monday ? true : false;
                this.form.tuesday = this.workingdays.tuesday ? true : false;
                this.form.wednesday = this.workingdays.wednesday ? true : false;
                this.form.thursday = this.workingdays.thursday ? true : false;
                this.form.friday = this.workingdays.friday ? true : false;
                this.form.saturday = this.workingdays.saturday ? true : false;
                this.form.sunday = this.workingdays.sunday ? true : false;
            },
            deep: true,
        },
    },
};
</script>


