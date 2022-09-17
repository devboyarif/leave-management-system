<template>
    <Head :title="__('Sign Up')" />

<div class="mt-5 pt-2 row align-items-center justify-content-center">
    <div class="auth-card-width">
        <div class="card card-outline card-primary card-width">
            <div class="card-header text-center">
                <a href="#" class="h1">
                    <Logo/>
                </a>
            </div>
            <div class="card-body">
                <form @submit.prevent="createData">
                    <h4 class="title">{{ __('Sign up to join the company') }}</h4>
                    <div class="email-login">
                        <!-- Name  -->
                        <label class="text-secondary" for="name"> <b>{{ __('Name') }}</b></label>
                        <input id="name" v-model="form.name" :class="{'border-danger':form.errors.name}" type="text"
                            :placeholder="__('Name')">
                        <span v-if="errors.name" class="d-block text-danger mt--10 mb-1">{{ form.errors.name }}</span>

                        <!-- Password  -->
                        <label class="text-secondary" for="password"> <b>{{ __('Password') }}</b></label>
                        <input id="password" v-model="form.password" :class="{'border-danger':form.errors.password}" type="password"
                            :placeholder="__('Password')">
                        <span v-if="errors.password" class="d-block text-danger mt--10 mb-1">{{ form.errors.password }}</span>

                        <!-- Password Confirmation  -->
                        <label class="text-secondary" for="confirm_password"> <b>{{ __('Confirm password') }}</b></label>
                        <input id="confirm_password" v-model="form.password_confirmation" :class="{'border-danger':form.errors.password_confirmation}" type="password"
                            :placeholder="__('Confirm password')">
                        <span v-if="errors.password_confirmation" class="d-block text-danger mt--10 mb-1">{{ form.errors.password_confirmation }}</span>

                        <!-- Phone  -->
                        <label class="text-secondary" for="email"> <b>{{ __('Phone') }}</b></label>
                        <vue-tel-input v-model="form.phone" mode="international"/>
                    </div>
                    <button :disabled="form.processing" type="submit" class="cta-btn bg-primary mt-3">
                        <Loading v-if="form.processing" :messageShow="false" />
                        <span v-else>{{ __('Sign Up') }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { VueTelInput } from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
import Logo from "../../Shared/Partials/Logo.vue";

export default {
    layout: "Auth",
    props: {
        token: {
            type: String,
            required: true,
        },
        errors: Object,
    },
    components: {
        VueTelInput,
        Logo
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                password: null,
                password_confirmation: null,
                terms_confirmed: null,
                phone: null,
                token: this.token,
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("company.store.employee"));
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
