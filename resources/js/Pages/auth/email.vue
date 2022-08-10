<template>

    <Head :title="__('Sign in')" />

    <div class="card-body">
        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>
        <form @submit.prevent="login">
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
                <div class="col-4">
                    <button :disabled="form.processing" type="submit" class="btn btn-primary btn-block">
                        <Loading v-if="form.processing" :messageShow="false"/>
                        <span v-else>{{ __('Sign In') }}</span>
                    </button>
                </div>
            </div>
        </form>

        <p class="mb-1">
            <a href="#">{{ __('I forgot my password') }}</a>
        </p>
        <p class="mb-0">
            <Link :href="route('register.form')" class="text-center">
            {{ __('Create company account') }}
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
        }
    },
};
</script>
