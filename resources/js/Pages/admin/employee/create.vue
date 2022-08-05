<template>
    <Head :title="__('Employee Create')"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Employee Create') }}</h3>
                        <Link :href="route('employees.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="createData">
                        <div class="mb-3 row">
                           <div class="col-md-6">
                                <Label :name="__('Name')" for="name"/>
                                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" id="name" :placeholder="__('Name')">
                                <ErrorMessage :name="form.errors.name"/>
                            </div>
                           <div class="col-md-6">
                                <Label :name="__('Email address')" for="email"/>
                                <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid':form.errors.email}" id="email" :placeholder="__('Email address')">
                                <ErrorMessage :name="form.errors.email"/>
                           </div>
                        </div>
                         <div class="mb-3 row">
                             <div class="col-md-6">
                                <Label :name="__('Company')"/>
                                <select @change="loadTeams" class="form-control" v-model="form.company_id" :class="{'is-invalid':form.errors.company_id}">
                                    <option value="" class="d-none">{{ __('Select Company') }}</option>
                                    <option v-for="company in companies" :key="company.id" :value="company.id">
                                        {{ company.user.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.company_id"/>
                            </div>
                            <div class="col-md-6">
                                <Label :name="__('Team')"/>
                                <select class="form-control" v-model="form.team_id" :class="{'is-invalid':form.errors.team_id}" :disabled="!teams.length">
                                    <option value="" class="d-none">{{ __('Select Team') }}</option>
                                    <option v-for="team in teams" :key="team.id" :value="team.id">
                                        {{ team.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.team_id"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Password')" for="password"/>
                                <input v-model="form.password" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password}" id="password" :placeholder="__('Password')">
                                <ErrorMessage :name="form.errors.password" />
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Confirm Password')" for="password_confirmation"/>
                                <input v-model="form.password_confirmation" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password_confirmation}" id="password_confirmation" :placeholder="__('Confirm Password')">
                                <ErrorMessage :name="form.errors.password_confirmation" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Phone Number')"/>
                                <vue-tel-input v-model="form.phone" mode="international"/>
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Avatar')" :required="false"/>
                                <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.avatar = $event.target.files[0]" :class="{'is-invalid':form.errors.avatar}"/>
                                <ErrorMessage :name="form.errors.avatar"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-check mr-1"></i>
                            {{ __('Save') }}
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueTelInput } from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

export default {
    props: {
        companies: {
            type: Array,
            required: true,
        },
    },
    components: {
        VueTelInput,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                avatar: '',
                company_id: "",
                team_id: "",
                phone: '',
            }),

            teams: [],
        };
    },
    methods: {
        createData() {
            this.form.post(route("employees.store"), {
               onSuccess: () => {
                    this.form.reset()
                },
            });
        },
        async loadTeams() {
            let response = await axios.get(
                route("companies.teams", this.form.company_id)
            );
            this.teams = response.data.teams;
        },
    },
     mounted(){
        this.checkPagePermission('admin')
    }
};
</script>
