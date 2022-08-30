<template>
     <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Invite your team members to manage their leave</h3>
        <p class="h5 text-center mb-3">Add team members and assign them to a team. Skip this step if you want to do this later.</p>
    </div>
    <div class="email-login">
        Step 3
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
        <div class="d-flex justify-content-end">
            <button type="button" class="cta-btn bg-secondary w-25" @click="$emit('step', 3)">
                {{ __('Skip') }}
            </button>
            <button type="button" class="cta-btn bg-primary w-25 ml-2" @click="$emit('step', 4)">
                {{ __('Next') }}
            </button>
       </div>
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

