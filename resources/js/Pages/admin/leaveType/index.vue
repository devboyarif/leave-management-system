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
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
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
                                        </td>
                                        <td>
                                            {{ leave_type.balance }} days
                                        </td>
                                        <td>
                                            <span v-if="leave_type.auto_approve" class="badge badge-pill badge-info mx-1">
                                                Allow auto approve
                                            </span>
                                            <span class="badge badge-pill mx-1" :class="leave_type.status ? 'badge-success':'badge-danger'">
                                                <span v-if="leave_type.status">Active</span>
                                                <span v-else>Inactive</span>
                                            </span>
                                        </td>
                                        <td class="d-flex">
                                            <Link :href="route('leaveTypes.edit',leave_type.id)" v-tooltip="'Edit Leave Type'" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(leave_type.id)" v-tooltip="'Delete Leave Type'" class="btn btn-sm">
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
                        <Pagination :links="leave_types.links" />
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
                    Inertia.delete(route("leaveTypes.destroy", id));
                }
            });
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
