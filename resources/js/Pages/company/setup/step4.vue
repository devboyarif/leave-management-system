<template>
    <Head title="Step 4 (4/5)"/>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Setup your company's working days</h3>
        <p class="h5 text-center mb-3">Please check the working days you want to add for the application</p>
    </div>
    <div class="email-login mt-4">
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
            </div>
        </form>
        <button type="button" class="cta-btn bg-primary w-25 ml-auto" @click="$emit('step', 5)">
            {{ __('Next') }}
        </button>
    </div>
</template>


<script>
    export default {
    data() {
        return {
            errors: {},

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
            this.form.put(route("company.workingdays.update"));
        },
    },
    mounted() {

    },
};
</script>

