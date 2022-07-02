<template>

    <Head title="Team List" />

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="card-title">
                            Team List
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>Name</th>
                                    <th>Employees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="teams && teams.data.length">
                                    <tr v-for="(team,index) in teams.data" :key="index">
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
                                            <small v-else>{{ __('No Employee Found') }}</small>
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
                                        <h6>No DataFound</h6>
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
                            <div class="mb-3" v-if="!isEditMode">
                                <Label name="Invite Employee" :required="false"/>
                                <div class="row my-1" v-for="(email, index) in form.emails" :key="index">
                                    <div class="col-lg-10">
                                        <input v-model="form.emails[index]" type="email" class="form-control">
                                    </div>
                                    <div class="col-lg-2" v-if="index == 0">
                                        <button type="button" class="btn btn-primary" @click="addMore">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-lg-2" v-else>
                                        <button type="button" class="btn btn-danger" @click="removeField(index)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
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
import Pagination from "../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        teams: Array,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: null,
            form: this.$inertia.form({
                name: "",
                emails: [""],
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            this.form.post(route("company.teams.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editTeam(team) {
            this.form.clearErrors();
            this.isEditMode = true;
            this.selectedId = team.id;
            this.form.name = team.name;
        },
        cancelEdit() {
            this.form.clearErrors();
            this.isEditMode = false;
            this.form.reset();
        },
        updateData() {
            this.form.put(route("company.teams.update", this.selectedId), {
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
                    Inertia.delete(route("company.teams.destroy", id));
                }
            });
        },
        addMore() {
            this.form.emails.push("");
        },
        removeField(index) {
            this.form.emails.splice(index, 1);
        },
    },
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
