<template>
    <Head title="Step 3 (3/5)"/>
     <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Invite your team members to manage their leave</h3>
        <p class="h5 text-center mb-3">Add team members and assign them to a team. Skip this step if you want to do this later.</p>
    </div>
    <div class="email-login">
        <div class="row my-1 justify-content-center" v-for="(email, index) in form.emails" :key="index">
            <div class="col-lg-5">
                <input v-model="form.emails[index]" :class="{'border-danger':form.errors.emails}" type="text" :placeholder="__('Employee Email')" class="d-block">
            </div>
            <div class="col-lg-5">
                <select v-model="form.teams[index]" :class="{'border-danger':form.errors.teams}">
                    <option value="" class="d-none">{{ __('Select Team') }}</option>
                    <option value="1">Backend</option>
                    <option value="2">Frontend</option>
                    <option value="3">UI/UX</option>
                </select>
            </div>
            <div class="col-lg-1" v-if="index == 0">
                <button type="button" class="cta-btn bg-primary mt-0" @click="addMore">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col-lg-1" v-else>
                <button type="button" class="cta-btn bg-danger mt-0" @click="removeField(index)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
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
                emails: [""],
                teams: [""],
            }),
            errors: {},
        };
    },
    methods: {
        addMore() {
            this.form.teams.push("");
            this.form.emails.push("");
        },
        removeField(index) {
            this.form.emails.splice(index, 1);
            this.form.teams.splice(index, 1);
        },
    },
    mounted() {

    },
};
</script>

