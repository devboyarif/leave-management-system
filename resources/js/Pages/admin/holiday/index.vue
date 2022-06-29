<template>

    <Head title="Company List" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Company List</span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
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
                                        {{ user.holidays_count }} {{ pluralize(user.holidays_count, 'Day') }}
                                    </td>
                                    <td>
                                        <Link v-tooltip="'Show all official holidays'" :href="route('holidays.show',user.id)" class="btn btn-info">
                                        <i class="fa-solid fa-eye"></i>
                                        Holidays
                                        </Link>
                                        <Link v-tooltip="'Show all requested holidays'" class="btn btn-warning ml-1"
                                            :href="route('request.holidays.index', user.company.id)">
                                            <i class="fa-solid fa-eye"></i>
                                            Requested Holidays
                                        </Link>
                                    </td>
                                </tr>
                            </template>
                             <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h3>No Data Found</h3>
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
    components: {
        Inertia,
        Pagination,
    },
    data() {
        return {
            //
        };
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
