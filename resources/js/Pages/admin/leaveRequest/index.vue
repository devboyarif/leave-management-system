<template>

    <Head title="Company List" />

    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <div class="row justify-content-center">
                <div class="col-12 ">
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-xl-3">
                            <select v-model="filterForm.user_id" class="form-control">
                                <option value="all" class="d-none">Select Company</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2 col-xl-2">
                            <button @click="getCompanyWiseRequest" class="btn btn-primary btn-outline">
                                Get Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" v-if="leaveRequests && leaveRequests.data.length">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Leave Request List</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Team</th>
                                <th>Status</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="leaveRequests && leaveRequests.data.length">
                                <tr v-for="(leaveRequest,index) in leaveRequests.data" :key="index">
                                    <td>
                                        <img :src="leaveRequest.employee.user.avatar" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        {{ leaveRequest.employee.user.name }}
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                        <small class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            12%
                                        </small>
                                        12,000 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
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
                    <Pagination :links="leaveRequests.links" />
                </div>
            </div>
            <!-- <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Leave Request List</span>

                    </div>
                    <input v-model="search" type="text" placeholder="Search.." class="form-control w-50">
                            <Link :href="route('leaveRequests.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                Create
                            </Link>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead class="thead-light">
                            <tr>
                                <th>Employee</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="leaveRequests && leaveRequests.data.length">
                                <tr v-for="(leaveRequest,index) in leaveRequests.data" :key="index">



                                    <td>
                                            <Link :href="route('leaveRequests.edit',user.id)" class="btn btn-primary mx-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                            </Link>
                                            <a @click="deleteCompany(user.id)" href="#"
                                                class="btn btn-danger mx-1">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete</a>
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

                    <Pagination :links="leaveRequests.links" />
                </div>
            </div> -->
        </div>
    </div>
    <div class="row justify-content-center" v-else>
        <div class="col-12 text-center mt-5 pt-5">
            <h3>Please select a company</h3>
        </div>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        users: Array,
        filters: Object || Array,
        leaveRequests: Array,
        filterRequest: Number,
    },
    components: {
        Pagination,
        Inertia,
    },
    data() {
        return {
            // search: this.filters.search,
            filterForm: this.$inertia.form({
                user_id: this.filterRequest.user_id || "all",
            }),
        };
    },
    methods: {
        deleteCompany(id) {
            if (confirm("Are you sure to delete?")) {
                Inertia.delete(route("leaveRequests.destroy", id));
            }
        },
        getCompanyWiseRequest() {
            this.filterForm.get(route("leaveRequests.index"));
            console.log(this.filterForm);
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
</style>
