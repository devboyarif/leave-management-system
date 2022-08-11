<template>

    <Head :title="__('Sign in')" />
    <div class="mt-5 pt-2 row align-items-center justify-content-center">
        <div class="auth-card-width">
            <div class="card card-outline card-primary card-width">
                <div class="card-header text-center">
                    <a href="#" class="h1">
                        <Logo/>
                    </a>
                </div>
                <div class="card-body">
                    <form @submit.prevent="login">
                        <h2 class="title">{{ __('Sign in') }}</h2>
                        <p class="subtitle">{{ __("Don't have an account") }}
                            <Link :href="route('register.form')">{{ __('Sign Up') }}</Link>
                        </p>
                        <div class="email-login">
                            <!-- Email  -->
                            <label class="text-secondary" for="email"> <b>{{ __('Email') }}</b></label>
                            <input v-model="form.email" :class="{'border-danger':form.errors.email}" type="text"
                                :placeholder="__('Email')">
                            <span v-if="errors.email" class="d-block text-danger mt--10 mb-1">{{ form.errors.email }}</span>

                            <!-- Password -->
                            <label class="text-secondary" for="psw"><b>{{ __('Password') }}</b></label>
                            <input v-model="form.password" :class="{'border-danger':form.errors.password}"
                                type="password" :placeholder="__('Password')">
                            <span v-if="errors.password" class="d-block text-danger mt--10 mb-1">{{ form.errors.password }}</span>
                        </div>
                        <button :disabled="form.processing" type="submit" class="cta-btn bg-primary">
                            <Loading v-if="form.processing" :messageShow="false" />
                            <span v-else>{{ __('Sign In') }}</span>
                        </button>

                        <Link :href="route('password.email')" class="text-center">{{ __('Forgot password') }}?</Link>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <button @click="roleLogin('admin@mail.com','password')" class="btn btn-secondary">Login Via Admin</button>
                        <button @click="roleLogin('company@mail.com', 'password')" class="btn btn-secondary mx-1">Login Via
                            Company</button>
                        <button @click="roleLogin('employee@mail.com', 'password')" class="btn btn-secondary">Login Via
                            Employee</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoginIcon from "../../Shared/Icons/LoginIcon.vue";
import Logo from "../../Shared/Partials/Logo.vue";

export default {
    layout: "Auth",
    props: {
        errors: Object,
    },
    components: {
        LoginIcon,
        Logo,
    },
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
        login() {
            this.form.post("/login");
        },
        roleLogin(email, password) {
            this.form.email = email;
            this.form.password = password;
            this.login();
        },
    },
};
</script>

<style scoped>
    .title {
        text-align: center;
        font-weight: bold;
        margin: 0;
    }

    .subtitle {
        text-align: center;
        font-weight: bold;
    }

    .email-login {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="password"] {
        padding: 15px 20px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
    }

    .cta-btn {
        padding: 16px 20px !important;
        margin-top: 10px;
        margin-bottom: 20px;
        width: 100%;
        border-radius: 10px;
        border: none;
    }

    .mt--10 {
        margin-top: -10px;
    }

    .auth-card-width {
        width: 500px !important;
    }
</style>
