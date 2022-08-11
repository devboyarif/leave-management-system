<template>

    <Head :title="__('Sign Up')" />

    <div class="mt-5 row align-items-center justify-content-center">
        <div class="auth-card-width">
            <div class="card card-outline card-primary card-width">
                <div class="card-header text-center">
                    <a href="#" class="h1">
                        <Logo />
                    </a>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createData">
                        <h2 class="title">{{ __('Sign up as company') }}</h2>
                        <p class="subtitle">{{ __("Already have an account") }}
                            <Link :href="route('login')">{{ __('Sign In') }}</Link>
                        </p>
                        <div class="email-login">
                            <!-- Name  -->
                            <label class="text-secondary" for="company_name"> <b>{{ __('Name') }}</b></label>
                            <input v-model="form.name" :class="{'border-danger':form.errors.name}"
                                type="text" :placeholder="__('Company Name')" id="company_name">
                            <span v-if="errors.name"
                                class="d-block text-danger mt--10 mb-1">{{ form.errors.name }}</span>

                            <!-- Email  -->
                            <label class="text-secondary" for="company_email"> <b>{{ __('Email') }}</b></label>
                            <input v-model="form.email" :class="{'border-danger':form.errors.email}"
                                type="text" :placeholder="__('Email')" id="company_email">
                            <span v-if="errors.email"
                                class="d-block text-danger mt--10 mb-1">{{ form.errors.email }}</span>

                            <!-- Country  -->
                            <label class="text-secondary" for="company_country"> <b>{{ __('Country') }}</b></label>
                             <select v-model="form.country" id="company_country" :class="{'border-danger':form.errors.country}">
                                <option value="" class="d-none">{{ __('Select Country') }}</option>
                                <option :value="country.id" v-for="country in countries" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                            <span v-if="errors.country"
                                class="d-block text-danger mt--10 mb-1">{{ form.errors.country }}</span>
                             <div class="icheck-primary">
                                <input @change="checkboxChange" v-model="form.import_official_holidays" type="checkbox" :checked="form.import_official_holidays" id="holiday">
                                <label for="holiday" class="ml-2 text-dark">
                                    {{ __('Import official holidays from country ?') }}
                                </label>
                            </div>

                             <!-- Password  -->
                            <label class="text-secondary" for="company_password"> <b>{{ __('Password') }}</b></label>
                            <input v-model="form.password" :class="{'border-danger':form.errors.password}"
                                type="password" :placeholder="__('Password')" id="company_password">
                            <span v-if="errors.password"
                                class="d-block text-danger mt--10 mb-1">{{ form.errors.password }}</span>
                        </div>
                        <div class="icheck-primary">
                            <input v-model="form.terms_confirmed" type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms" class="ml-2">
                                {{ __('I agree to the') }} <a :href="route('website.terms.condition')">{{ __('terms & condition') }}</a>
                            </label>
                        </div>
                        <button :disabled="form.processing" type="submit" class="cta-btn bg-primary">
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
import Logo from "../../Shared/Partials/Logo.vue";

export default {
    layout: "Auth",
    props: {
        countries: {
            type: Array,
            required: true,
        },
        errors: Object,
    },
    components: {
        Logo,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                country: "",
                password: null,
                terms_confirmed: null,
                import_official_holidays: true,
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("register"));
        },
        checkboxChange(e) {
            this.form.import_official_holidays = e.target.checked;
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
    select,
    input[type="password"] {
        padding: 15px 20px;
        margin-bottom: 8px;
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
        width: 600px !important;
    }
</style>
