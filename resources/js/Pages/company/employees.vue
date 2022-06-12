<template>
    <Head title="Company List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>Employee List</h4>
                            <!-- <input v-model="search" type="text" placeholder="Search.." class="form-control w-50"> -->
                           <div>

                            <div class="btn-group" :class="{'show':showEmployeeDropdown}" role="group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" @click="showEmployeeDropdown = !showEmployeeDropdown">
                                Create Employee
                                </button>
                                <div class="dropdown-menu employee-add-dropdown" :class="{'show':showEmployeeDropdown}" x-placement="bottom-start">
                                    <a @click="showEmployeeInviteModal = true" class="dropdown-item" href="javascript:void(0)" v-tooltip="'Invite employee via email address'">
                                        <i class="fa-regular fa-paper-plane"></i>
                                        Invite Employee
                                    </a>
                                    <a @click="showEmployeeCreateModal = true" class="dropdown-item" href="#" v-tooltip="'Create employee instant from here'">
                                        <i class="fa-solid fa-plus"></i>
                                        Instant Create
                                    </a>
                                </div>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>Employee</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="employees && employees.data.length">
                                    <tr v-for="(employee,index) in employees.data" :key="index">
                                        <td>
                                            <img :src="employee.user.avatar" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            {{ employee.user.name }}
                                        </td>
                                        <td>{{ employee.user.email }}</td>
                                        <td class="d-flex">
                                            <button @click="editData(employee)" v-tooltip="'Edit Employee'" class="btn btn-sm">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(employee.user.id)" v-tooltip="'Delete Employee'" class="btn btn-sm">
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
                        <Pagination :links="employees.links" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Invite Employee Modal -->
        <InviteEmployeeModal :show="showEmployeeInviteModal" @close="showEmployeeInviteModal = false" :teams="teams"/>

        <!-- Create Employee Modal -->
        <CreateEmployeeModal :show="showEmployeeCreateModal" @close="showEmployeeCreateModal = false" :teams="teams"/>

        <!-- Edit Employee Modal -->

        <EditEmployeeModal v-if="showEmployeeEditModal" :show="showEmployeeEditModal" @close="showEmployeeEditModal = false" :teams="teams" :employee="showEmployeeEditModal ? employee:''"/>
</template>


<script>
import Pagination from "../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";
import InviteEmployeeModal from "../../Shared/Company/Modal/InviteEmployeeModal.vue";
import CreateEmployeeModal from "../../Shared/Company/Modal/CreateEmployeeModal.vue";
import EditEmployeeModal from "../../Shared/Company/Modal/EditEmployeeModal.vue";

export default {
    props: {
        employees: Object,
        filters: Object || Array,
        teams: {
            type: Array,
            required: true,
        },
    },
    components: {
        Pagination,
        Inertia,
        InviteEmployeeModal,
        CreateEmployeeModal,
        EditEmployeeModal,
    },
    data() {
        return {
            showEmployeeDropdown: false,
            showEmployeeInviteModal: false,
            showEmployeeCreateModal: false,
            showEmployeeEditModal: false,
            teams: this.teams,
            employee: "",
            // search: this.filters.search,
        };
    },
    methods: {
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
                    Inertia.delete(route("company.employees.destroy", id));
                }
            });
            // if (confirm("Are you sure to delete?")) {
            //     Inertia.delete(route("employees.destroy", id));
            // }
        },
        editData(employee) {
            this.employee = employee;
            this.showEmployeeEditModal = true;
        },
    },
    watch: {
        // search: debounce((value) => {
        //     Inertia.get(
        //         "users",
        //         { search: value },
        //         {
        //             preserveState: true,
        //             replace: true,
        //         }
        //     );
        // }, 500),
    },
};
</script>

<style scoped>
.avatar-img {
    height: 60px;
    width: 60px;
    object-fit: cover;
}

.employee-add-dropdown{
    position: absolute;
    transform: translate3d(0px, 38px, 0px);
    top: 0px;
    left: 0px;
    will-change: transform;
}
</style>

