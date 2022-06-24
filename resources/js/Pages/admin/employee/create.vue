<template>
    <Head title="Employee Create"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Employee Create</h3>
                        <Link :href="route('employees.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="createData">
                        <div class="mb-3 row">
                           <div class="col-md-6">
                                <Label name="Name"/>
                                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" id="name">
                                <ErrorMessage :name="form.errors.name"/>
                            </div>
                           <div class="col-md-6">
                                <Label name="Email address"/>
                                <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid':form.errors.email}" id="email">
                                <ErrorMessage :name="form.errors.email"/>
                           </div>
                        </div>
                         <div class="mb-3 row">
                             <div class="col-md-6">
                                <Label name="Company"/>
                                <select @change="loadTeams" class="form-control" v-model="form.user_id" :class="{'is-invalid':form.errors.user_id}">
                                    <option value="" class="d-none">Select Company</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">
                                        {{ user.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.user_id"/>
                            </div>
                            <div class="col-md-6">
                                <Label name="Team"/>
                                <select class="form-control" v-model="form.team_id" :class="{'is-invalid':form.errors.team_id}" :disabled="!teams.length">
                                    <option value="" class="d-none">Select Team</option>
                                    <option v-for="team in teams" :key="team.id" :value="team.id">
                                        {{ team.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.team_id"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label name="Password"/>
                                <input v-model="form.password" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password}" id="password">
                                <ErrorMessage :name="form.errors.password" />
                            </div>
                            <div class="col-lg-6">
                                <Label name="Confirm Password"/>
                                <input v-model="form.password_confirmation" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password_confirmation}" id="password_confirmation">
                                <ErrorMessage :name="form.errors.password_confirmation" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <Label name="Avatar" :required="false"/>
                            <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.avatar = $event.target.files[0]" :class="{'is-invalid':form.errors.avatar}"/>
                            <ErrorMessage :name="form.errors.avatar"/>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                Save
                            </span>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
    components: {
        Inertia,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                avatar: null,
                user_id: "",
                team_id: "",
            }),

            teams: [],
        };
    },
    methods: {
        createData() {
            this.form.post(route("employees.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        async loadTeams() {
            let response = await axios.get(
                route("companies.teams", this.form.user_id)
            );
            this.teams = response.data.teams;
        },
    },
};
</script>
