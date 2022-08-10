<template>

    <Head :title="__('Reset Password')" />

    <div class="card-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>
        <form @submit.prevent="resetPassword">
              <div class="input-group mb-3">
                <input v-model="form.password" type="password" class="form-control" :placeholder="__('Password')"
                    :class="{'is-invalid':form.errors.password}">
                <ErrorMessage :name="form.errors.password" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password_confirmation" type="password" class="form-control"
                    :placeholder="__('Confirm Password')" :class="{'is-invalid':form.errors.password_confirmation}">
                <ErrorMessage :name="form.errors.password_confirmation" />
            </div>
            <div class="row">
                <button :disabled="form.processing" type="submit" class="btn btn-primary btn-block">
                    <Loading v-if="form.processing" :messageShow="false"/>
                    <span v-else>{{ __('Reset Password') }}</span>
                </button>
            </div>
        </form>

        <p class="mb-0">
            <Link :href="route('login')" class="text-center">
            {{ __('I already have a account') }}
            </Link>
        </p>
    </div>
</template>

<script>
import LoginIcon from "../../Shared/Icons/LoginIcon.vue";

export default {
    layout: "Auth",
    props: {
        errors: Object,
        email: String,
    },
    components: {
        LoginIcon,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: this.email,
                password: null,
                password_confirmation: null,
            }),
        };
    },
    computed: {
        disabledButton() {
            return this.form.code;
        },
    },
    methods: {
        resetPassword() {
            alert("resetPassword");
            this.form.post(route("password.reset"));
        },
    },
};
</script>
