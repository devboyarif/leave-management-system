<template>
    <Head title="Sign Up" />

    <div class="card-body">
        <p class="login-box-msg">Sign up to create your company</p>
        <form @submit.prevent="createData">
            <div class="input-group mb-3">
                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}"
                    placeholder="Company Name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.name" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.email" type="email" class="form-control" placeholder="Email"
                    :class="{'is-invalid':form.errors.email}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.email" />
            </div>
            <div class="input-group mb-3">
                <select v-model="form.country" id="" class="form-control" :class="{'is-invalid':form.errors.country}">
                    <option value="" class="d-none">Select Country</option>
                    <option :value="country.id" v-for="country in countries" :key="country.id">
                        {{ country.name }}
                    </option>
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa-solid fa-globe"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.country" />
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
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <Loading v-if="form.processing" />
                        Sign Up
                    </button>
                </div>

            </div>
        </form>
        <p class="mb-0">
            <Link :href="route('login')" class="text-center">
            I already have a account
            </Link>
        </p>
    </div>
</template>

<script>
export default {
    layout: "Auth",
    props: {
        countries: {
            type: Array,
            required: true,
        },
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                country: "",
                password: null,
                password_confirmation: null,
                terms_confirmed: null,
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
            // console.log(this.form);
            this.form.post(route("register"));
        },
    },
};
</script>
