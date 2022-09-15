<template>
    <Head title="Step 4 (4/5)"/>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">{{ __("Setup your companys working days") }}</h3>
        <p class="h5 text-center mb-3">{{ __("Please check the working days you want to add for the application") }}</p>
    </div>
    <form @submit.prevent="saveData">
        <div class="email-login mt-4">
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
            </div>
            <button :disabled="form.processing" type="submit" class="cta-btn bg-primary btn-sm w-25 ml-auto">
                <Loading v-if="form.processing" :messageShow="false" />
                <span v-else>{{ __('Next') }}</span>
            </button>
        </div>
    </form>
</template>


<script>
    export default {
    data() {
        return {
            form: this.$inertia.form({
                sunday: false,
                monday: true,
                tuesday: true,
                wednesday: true,
                thursday: true,
                friday: true,
                saturday: true,
            }),
        };
    },
    methods: {
        saveData() {
            this.form.post(route("company.account.setup.step4"), {
                onSuccess: () => {
                    this.$emit('step',5)
                }
            });
        }
    },
    mounted() {

    },
};
</script>

