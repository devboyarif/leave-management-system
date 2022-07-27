<template>
    <Head :title="__('Sign Up')" />

    <div class="card-body">
        <p class="login-box-msg">{{ __('Sign up to join the company') }}</p>
        <form @submit.prevent="createData">
            <div class="input-group mb-3">
                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}"
                    :placeholder="__('Full Name')">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.name" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                    :class="{'is-invalid':form.errors.password}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.password" />
            </div>
            <div class="input-group mb-3">
                <input v-model="form.password_confirmation" type="password" class="form-control"
                    :placeholder="__('Confirm password')" :class="{'is-invalid':form.errors.password_confirmation}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <ErrorMessage :name="form.errors.password_confirmation" />
            </div>
            <div class="input-group mb-3">
                  <vue-tel-input v-model="form.phone" mode="international"/>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input v-model="form.terms_confirmed" type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms" class="ml-2">
                            {{ __('I agree to the') }} <a href="#">{{ __('terms & condition') }}</a>
                        </label>
                    </div>
                    <ErrorMessage :name="form.errors.terms_confirmed" class="d-block" />
                </div>

                <div class="col-4">
                    <button :disabled="form.processing"  class="btn btn-primary btn-block">
                        <Loading v-if="form.processing" message="Signing Up..."/>
                        <span v-else>{{ __('Sign Up') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

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
            console.log(this.form);
            this.form.post(route("company.store.employee"));
        },
    },
     mounted(){
        this.checkPagePermission('company')
    }
};
</script>
