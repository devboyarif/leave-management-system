<template>
    <Head title="Admin List"/>

    <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Team List</span>
                            <select @change="companyWiseTeam" v-model="filterForm.user_id" class="form-control w-25">
                                <option value="all">All</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table mb-4">
                            <thead class="thead-light">
                                <tr>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="teams && teams.data.length">
                                    <tr v-for="(team,index) in teams.data" :key="index">
                                        <td>{{ team.company.user.name }}</td>
                                        <td>{{ team.name }}</td>
                                        <td>
                                            <a @click="editTeam(team)" href="#"
                                                class="btn btn-primary mx-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </a>
                                            <a @click="deleteData(team.id)" href="#"
                                                class="btn btn-danger mx-1">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h3>No User Found</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination  -->
                        <Pagination :links="teams.links" />
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span v-if="!isEditMode">Create Team</span>
                            <span v-else>Edit Team</span>
                        </div>
                    </div>
                    <div class="card-body">
                         <form @submit.prevent="saveData">
                            <div class="mb-3">
                                <Label name="Name"/>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.name}" id="name">
                                <ErrorMessage :name="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <Label name="Company"/>
                                <select v-model="form.user_id" id="company" class="form-control"
                                    :class="{'is-invalid':form.errors.user_id}">
                                    <option value="" class="d-none">Select Company</option>
                                    <option :value="user.id" v-for="user in users" :key="user.id">
                                        {{ user.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.user_id" />
                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <i v-if="!form.processing" class="fa-solid fa-check"></i>
                                <Loading v-else/>
                                Save
                            </button>
                            <button v-if="isEditMode" @click="cancelEdit" type="button" class="btn btn-danger ml-2">
                                <i class="fa-solid fa-times"></i>
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
import Pagination from "../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        teams: Object,
        users: Array,
        filterUserId: Number,
        // filters: Object || Array,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: null,
            // search: this.filters.search,
            form: this.$inertia.form({
                name: null,
                user_id: "",
            }),

            filterForm: this.$inertia.form({
                user_id: this.filterUserId || "all",
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            this.form.post(route("teams.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editTeam(team) {
            this.isEditMode = true;
            this.selectedId = team.id;
            this.form.name = team.name;
            this.form.user_id = team.company.user_id;
        },
        cancelEdit() {
            this.isEditMode = false;
            this.form.reset();
        },
        updateData() {
            this.form.put(route("teams.update", this.selectedId), {
                onSuccess: () => {
                    this.isEditMode = false;
                    this.form.reset();
                },
            });
        },
        deleteData(id) {
            if (confirm("Are you sure to delete this user?")) {
                Inertia.delete(route("teams.destroy", id));
            }
        },
        companyWiseTeam() {
            this.filterForm.get(route("teams.index"));
        },
    },
    mounted() {
        // if (this.users.length) {
        //     this.filterForm.user_id = this.users[0].id;
        //     this.companyWiseTeam();
        // }
    },
    // watch: {
    //     search: debounce((value) => {
    //         Inertia.get(
    //             "users",
    //             { search: value },
    //             {
    //                 preserveState: true,
    //                 replace: true,
    //             }
    //         );
    //     }, 500),
    // },
};
</script>

<style scoped>
.avatar-img {
    height: 60px;
    width: 60px;
    object-fit: cover;
}
</style>
