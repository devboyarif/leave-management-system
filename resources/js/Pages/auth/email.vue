<template>

    <Head :title="__('Forget Password')" />

     <div class="mt-5 pt-2 row align-items-center justify-content-center">
        <div class="auth-card-width">
            <div class="card card-outline card-primary card-width">
                <div class="card-header text-center">
                    <a href="#" class="h1">
                        <Logo/>
                    </a>
                </div>
                <div class="card-body">
                    <form @submit.prevent="sendCode">
                        <h2 class="title">{{ __('Forget Password') }}</h2>
                        <p class="subtitle">{{ __("Already have an account") }}
                            <Link :href="route('login')">{{ __('Sign In') }}</Link>
                        </p>
                        <div class="email-login">
                            <!-- Email  -->
                            <label class="text-secondary" for="email"> <b>{{ __('Email') }}</b></label>
                            <input v-model="form.email" :class="{'border-danger':form.errors.email}" type="email"
                                :placeholder="__('Email')">
                            <span v-if="errors.email" class="d-block text-danger mt--10 mb-1">{{ form.errors.email }}</span>
                        </div>
                        <button :disabled="form.processing" type="submit" class="cta-btn bg-primary">
                            <Loading v-if="form.processing" :messageShow="false" />
                            <span v-else>{{ __('Send Reset Code') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "../../Shared/Partials/Logo.vue";

export default {
    layout: "Auth",
    props: {
        errors: Object,
    },
    components: {
        Logo,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: "",
            }),
        };
    },
    computed: {
        disabledButton() {
            return this.form.email && this.form.password;
        },
    },
    methods: {
        sendCode() {
            this.form.post(route("password.email.send.code"));
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

    input[type="email"]{
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
