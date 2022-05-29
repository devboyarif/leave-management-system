<template>
    <Head title="Sign in"/>

    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form @submit.prevent="createData">
            <div class="input-group mb-3">
                <input v-model="form.email" :class="{'is-invalid':form.errors.email}" type="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <span v-if="errors.email" class="invalid-feedback">{{ form.errors.email }}</span>
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password" type="password"  :class="{'is-invalid':form.errors.password}" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <span v-if="errors.password" class="invalid-feedback">{{ form.errors.password }}</span>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember" class="ml-2">
                            Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>

            </div>
        </form>

        <p class="mb-1">
            <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
            <Link :href="route('register.form')" class="text-center">
                Create company account
            </Link>
        </p>
    </div>
</template>

<script>
export default {
    layout: "Auth",
    props: { errors: Object },
    data() {
        return {
            form: this.$inertia.form({
                email: null,
                password: null,
            }),
        };
    },
    computed: {
        disabledButton() {
            return this.form.email && this.form.password;
        },
    },
    methods: {
        createData() {
            this.form.post("/login");
        },
    },
};
</script>
