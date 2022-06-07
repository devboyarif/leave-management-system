<template>
    <Head title="Company List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <input v-model="search" type="text" placeholder="Search.." class="form-control w-50">
                            <Link :href="route('employees.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                Create
                            </Link>
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
                                    <tr v-for="(user,index) in employees.data" :key="index">
                                        <td>
                                            <img :src="user.avatar" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            {{ user.name }}
                                        </td>
                                        <td>{{ user.email }}</td>
                                        <td class="d-flex">
                                            <Link :href="route('employees.edit',user.id)" v-tooltip="'Edit Employee'" class="btn btn-sm mx-1">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(user.id)" v-tooltip="'Delete Employee'" class="btn btn-sm mx-1">
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
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        employees: Object,
        filters: Object || Array,
    },
    components: {
        Pagination,
        Inertia,
    },
    data() {
        return {
            search: this.filters.search,
        };
    },
    methods: {
        deleteData(id) {
            if (confirm("Are you sure to delete?")) {
                Inertia.delete(route("employees.destroy", id));
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
</style>
