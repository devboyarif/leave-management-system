<template>

    <Head :title="__('Reset Email')" />

    <div class="card-body">
        <p class="login-box-msg">{{ __('Reset Email') }}</p>
        <form @submit.prevent="sendCode">
            <div class="input-group mb-3">
                <input v-model="form.email" :class="{'is-invalid':form.errors.email}" type="email" class="form-control"
                    :placeholder="__('Email')">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <span v-if="errors.email" class="invalid-feedback">{{ form.errors.email }}</span>
            </div>
            <div class="row">
                <button :disabled="form.processing" type="submit" class="btn btn-primary btn-block">
                    <Loading v-if="form.processing" :messageShow="false"/>
                    <span v-else>{{ __('Send Code') }}</span>
                </button>
                <div class="col-4">
                </div>
            </div>
        </form>

        <p class="mb-0">
            <Link :href="route('login')" class="text-center">
            {{ __('Already have a account') }}
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
    },
    components: {
        LoginIcon,
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
