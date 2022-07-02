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
            <div class="input-group mb-3">
                <input v-model="form.password" type="password" :class="{'is-invalid':form.errors.password}"
                    class="form-control" :placeholder="__('Password')">
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
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

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
    <div class="card mt-2">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer">
                        <td>admin@mail.com</td>
                        <td>password</td>
                        <td>Admin</td>
                        <td>
                            <button @click="roleLogin('admin@mail.com','password')" class="btn btn-primary btn-sm">
                                <LoginIcon/>
                            </button>
                        </td>
                    </tr>
                    <tr class="cursor-pointer">
                        <td>company@mail.com</td>
                        <td>password</td>
                        <td>Company</td>
                        <td>
                            <button @click="roleLogin('company@mail.com', 'password')" class="btn btn-primary btn-sm">
                                <LoginIcon/>
                            </button>
                        </td>
                    </tr>
                    <tr class="cursor-pointer">
                        <td>employee@mail.com</td>
                        <td>password</td>
                        <td>Employee</td>
                        <td>
                            <button @click="roleLogin('employee@mail.com', 'password')" class="btn btn-primary btn-sm">
                                <LoginIcon/>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
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
        },
        roleLogin(email, password) {
            this.form.email = email;
            this.form.password = password;
            this.login();
        },
    },
};
</script>
