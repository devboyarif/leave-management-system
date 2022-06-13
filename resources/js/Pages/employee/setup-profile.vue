<template>

    <Head title="Account Setup" />

    <div class="card-body">
        <p class="login-box-msg">Complete Setup</p>
        <!-- <form @submit.prevent="login">
            <div class="input-group mb-3">
                <input v-model="form.email" :class="{'is-invalid':form.errors.email}" type="email" class="form-control"
                    placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                <span v-if="errors.email" class="invalid-feedback">{{ form.errors.email }}</span>
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password" type="password" :class="{'is-invalid':form.errors.password}"
                    class="form-control" placeholder="Password">
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
                    <button :disabled="form.processing" type="submit" class="btn btn-primary btn-block">
                        <Loading v-if="form.processing" :messageShow="false"/>
                        <span v-else>Sign In</span>
                    </button>
                </div>
            </div>
        </form> -->
    </div>
</template>

<script>
import LoginIcon from "../../Shared/Icons/LoginIcon.vue";

export default {
    props: {
        errors: Object,
    },
    components: {
        LoginIcon,
    },
    data() {
        return {
            // form: this.$inertia.form({
            //     email: null,
            //     password: null,
            // }),
        };
    },
    computed: {
        // disabledButton() {
        //     return this.form.email && this.form.password;
        // },
    },
    methods: {
        // login() {
        //     this.form.post("/login");
        // },
        // roleLogin(email, password) {
        //     this.form.email = email;
        //     this.form.password = password;
        //     this.login();
        // },
    },
};
</script>
