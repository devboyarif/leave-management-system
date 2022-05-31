<template>
    <Head title="Leave Type List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <input v-model="search" type="text" placeholder="Search.." class="form-control w-50">
                            <Link :href="route('leaveTypes.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                Create
                            </Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Allow Half Day</th>
                                    <th>Auto Approve</th>
                                    <th>Leave Balance</th>
                                    <th>Status</th>
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
                                        <td>{{ leave_type.allow_half_day }}</td>
                                        <td>{{ leave_type.auto_approve }}</td>
                                        <td>{{ leave_type.balance }}</td>
                                        <td>{{ leave_type.status }}</td>
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
        // filters: Object || Array,
    },
    components: {
        Inertia,
        Pagination,
    },
    data() {
        return {
            // search: this.filters.search,
        };
    },
    methods: {
        deleteData(id) {
            if (confirm("Are you sure to delete this user?")) {
                Inertia.delete(route("leaveTypes.destroy", id));
            }
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
