<template>
    <Head title="Leave Type List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                             <span>Leave Type List</span>
                            <div class="row">
                                <div class="col-6">
                                    <select @change="companyWiseLeaveType" v-model="filterForm.user_id" class="form-control w-100">
                                       <option value="all">All</option>
                                       <option v-for="user in users" :key="user.id" :value="user.id">
                                           {{ user.name }}
                                       </option>
                                   </select>

                                </div>
                                <div class="col-6 text-right">
                                    <!-- <input v-model="search" type="text" placeholder="Search.." class="form-control w-50"> -->
                                        <Link :href="route('leaveTypes.create')" class="btn btn-primary">
                                            <i class="fa-solid fa-plus"></i>
                                            Create
                                        </Link>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Leave Balance</th>
                                    <th>Options</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <template v-if="leave_types && leave_types.data.length">
                                    <tr v-for="(leave_type,index) in leave_types.data" :key="index">
                                        <td>{{ leave_type.name }}</td>
                                        <td>
                                            {{ leave_type.color }}

                                            <!-- <span class="badge" style="">

                                            </span> -->
                                            <!-- <span class="m-badge m-badge--lg m-badge--very-wide" style="margin-left: 30px; width: 10px; height: 10px; background-color: rgb(255, 8, 51);"></span> -->
                                        </td>
                                        <td>
                                            {{ leave_type.balance }} days
                                        </td>
                                        <td>
                                            <span v-if="leave_type.allow_half_day" class="badge badge-pill badge-primary mx-1">
                                                Allow half day
                                            </span>
                                            <span v-if="leave_type.auto_approve" class="badge badge-pill badge-info mx-1">
                                                Allow auto approve
                                            </span>
                                            <span class="badge badge-pill mx-1" :class="leave_type.status ? 'badge-success':'badge-danger'">
                                                <span v-if="leave_type.status">Active</span>
                                                <span v-else>Inactive</span>
                                            </span>
                                        </td>
                                        <td>
                                            <Link :href="route('leaveTypes.edit',leave_type.id)"
                                                class="btn btn-primary mx-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                            </Link>
                                            <a @click="deleteData(leave_type.id)" href="#"
                                                class="btn btn-danger mx-1">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h3>No data Found</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination  -->
                        <Pagination :links="leave_types.links" />
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
        leave_types: Array,
        users: Array,
        // filters: Object || Array,
    },
    components: {
        Inertia,
        Pagination,
    },
    data() {
        return {
            filterForm: this.$inertia.form({
                user_id: this.filterUserId || "all",
            }),
            // search: this.filters.search,
        };
    },
    methods: {
        deleteData(id) {
            if (confirm("Are you sure to delete?")) {
                Inertia.delete(route("leaveTypes.destroy", id));
            }
        },
        companyWiseLeaveType() {
            this.filterForm.get(route("leaveTypes.index"));
        },
    },
    watch: {
        search: debounce((value) => {
            Inertia.get(
                "users",
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
    },
};
</script>

<style scoped>
.avatar-img {
    height: 60px;
    width: 60px;
    object-fit: cover;
}

.custom-color-box {
    margin-left: 30px;
    width: 10px;
    height: 10px;
    background-color: rgb(255, 8, 51);
}
</style>
