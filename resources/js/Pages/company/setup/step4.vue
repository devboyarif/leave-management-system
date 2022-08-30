<template>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Setup your company's working days</h3>
        <p class="h5 text-center mb-3">Please check the working days you want to add for the application</p>
    </div>
    <div class="email-login">
        Step 4
        <!-- <div class="row">
            <div class="col-lg-6">
                <AuthLabel name="Company Name" />
                <input v-model="form.company_name" :class="{'border-danger':form.errors.company_name}" type="text"
                    :placeholder="__('Company Name')" id="company_name" class="d-block">
                <span v-if="errors.company_name" class="d-block text-danger mt--10 mb-1">{{ form.errors.company_name }}</span>
            </div>

            <button :disabled="form.processing" type="submit" class="cta-btn bg-primary w-25 ml-auto">
                <Loading v-if="form.processing" :messageShow="false" />
                <span v-else>{{ __('Next') }}</span>
            </button>
        </div> -->
        <button type="button" class="cta-btn bg-primary w-25 ml-auto" @click="$emit('step', 5)">
            {{ __('Next') }}
        </button>
    </div>
</template>


<script>
    export default {
    data() {
        return {
            form: this.$inertia.form({
                company_name: "",
            }),
            errors: {},
        };
    },
    methods: {

    },
    mounted() {

    },
};
</script>

