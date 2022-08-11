<template>

    <Head :title="__('Sign in')" />

    <div class="card-body">
        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
        <form @submit.prevent="checkCode">
            <div class="input-group mb-3">
                <input v-model="form.code" :class="{'is-invalid':form.errors.code}" type="text" class="form-control"
                    :placeholder="__('Code')">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <span v-if="errors.code" class="invalid-feedback">
                    {{ form.errors.code }}
                </span>
            </div>
            <div class="row">
                <button :disabled="form.processing" type="submit" class="btn btn-primary btn-block">
                    <Loading v-if="form.processing" :messageShow="false"/>
                    <span v-else>{{ __('Check Code') }}</span>
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
        email: String,
    },
    components: {
        LoginIcon,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: this.email,
                code: "",
            }),
        };
    },
    computed: {
        disabledButton() {
            return this.form.code;
        },
    },
    methods: {
        checkCode() {
            this.form.post(route("password.email.check.code"));
        },
    },
};
</script>
