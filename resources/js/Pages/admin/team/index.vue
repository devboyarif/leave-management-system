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
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>Company</th>
                                    <th>Name</th>
                                    <th>Employees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="teams && teams.data.length">
                                    <tr v-for="(team,index) in teams.data" :key="index">
                                        <td>{{ team.company.user.name }}</td>
                                        <td>{{ team.name }}</td>
                                        <td>
                                            <ul class="list-inline" v-if="team.employees && team.employees.length">
                                                <li class="list-inline-item" v-for="(employee, key) in team.employees" :key="employee.id" v-tooltip="employee.user.name">
                                                    <img v-if="employee.user && key <= 4" alt="Avatar" class="table-avatar" :src="employee.user.avatar">
                                                </li>
                                                <li class="list-inline-item m-0 p-0" v-if="team.employees.length > 5">
                                                        +{{ team.employees.length - 5 }}

                                                </li>
                                            </ul>
                                            <small v-else>No employee found</small>
                                        </td>
                                        <td class="d-flex">
                                            <button @click="editTeam(team)" v-tooltip="'Delete Leave Type'" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(team.id)" v-tooltip="'Delete Leave Type'" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
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
                                <Loading v-if="form.processing"/>
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    Save
                                </span>
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
import Pagination from "../../../Shared/Pagination.vue";
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
             this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(route("teams.destroy", id));
                }
            });
        },
        companyWiseTeam() {
            this.filterForm.get(route("teams.index"));
        },
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

.table-avatar{
    height: 25px;
    width: 25px;
    object-fit: cover;
    border-radius: 50%;
    display: inline;
}
</style>
