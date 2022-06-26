<template>
    <Head title="Sign Up" />

    <div class="card-body">
        <p class="login-box-msg">Sign up to join the company</p>
        <form @submit.prevent="createData">
            <div class="input-group mb-3">
                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}"
                    placeholder="Full Name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.name" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                    :class="{'is-invalid':form.errors.password}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.password" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password_confirmation" type="password" class="form-control"
                    placeholder="Confirm password" :class="{'is-invalid':form.errors.password_confirmation}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.password_confirmation" />
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input v-model="form.terms_confirmed" type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms" class="ml-2">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                    <ErrorMessage :name="form.errors.terms_confirmed" class="d-block" />
                </div>

                <div class="col-4">
                    <button :disabled="form.processing"  class="btn btn-primary btn-block">
                        <Loading v-if="form.processing" message="Signing Up..."/>
                        <span v-else>Sign Up</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    layout: "Auth",
    props: {
        token: {
            type: String,
            required: true,
        },
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                password: null,
                password_confirmation: null,
                terms_confirmed: null,
                token: this.token,
            }),
        };
    },
    // computed: {
    //     disabledButton() {
    //         return this.form.email && this.form.password;
    //     },
    // },
    methods: {
        createData() {
            console.log(this.form);
            this.form.post(route("company.store.employee"));
        },
    },
};
</script>
