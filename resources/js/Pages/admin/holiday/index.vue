<template>
    <Head title="Company List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                             <span>Company List</span>
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
                                    <th>Country</th>
                                    <th>Total Holidays</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <template v-if="users && users.data.length">
                                    <tr v-for="(user,index) in users.data" :key="index">
                                        <td>{{ user.name }}</td>
                                        <td v-if="user.company.country">
                                            {{ user.company.country.name }}
                                        </td>
                                        <td>
                                            {{ user.holidays_count }}
                                        </td>
                                        <td>
                                            <Link :href="route('holidays.show',user.id)"
                                                class="btn btn-info mx-1">
                                            <i class="fa-solid fa-eye"></i>
                                            Show Holidays
                                            </Link>
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
                        <Pagination :links="users.links" />
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
        // users: Array,
        users: Array,
        // filters: Object || Array,
    },
    // components: {
    //     Inertia,
    //     Pagination,
    // },
    data() {
        return {
            // filterForm: this.$inertia.form({
            //     user_id: this.filterUserId || "all",
            // }),
            // search: this.filters.search,
        };
    },
    methods: {
        // deleteData(id) {
        //     if (confirm("Are you sure to delete?")) {
        //         Inertia.delete(route("leaveTypes.destroy", id));
        //     }
        // },
        // companyWiseLeaveType() {
        //     this.filterForm.get(route("leaveTypes.index"));
        // },
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
