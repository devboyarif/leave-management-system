<template>
    <Head title="Step 2 (2/5)"/>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Create your team members</h3>
        <p class="h5 text-center mb-3">To manage and organize employees and leaves, you can divide your employees into teams.</p>
    </div>
    <div class="email-login mt-4">
        <div class="row my-1 justify-content-center" v-for="(name, index) in form.names" :key="index">
            <div class="col-lg-8">
                <input v-model="form.names[index]" :class="{'border-danger':form.errors.names}" type="text" :placeholder="__('Team Name')" id="company_name" class="d-block">
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
       <div class="d-flex justify-content-end mt-4">
            <button type="button" class="cta-btn bg-secondary w-25" @click="$emit('step', 3)">
                {{ __('Skip') }}
            </button>
            <button type="button" class="cta-btn bg-primary w-25 ml-2" @click="$emit('step', 3)">
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
                names: [""],
            }),

            errors: {},
        };
    },
    methods: {
        addMore() {
            this.form.names.push("");
        },
        removeField(index) {
            this.form.names.splice(index, 1);
        },
    },
    mounted() {

    },
};
</script>

