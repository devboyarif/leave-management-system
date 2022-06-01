<template>
    <Head title="Admin List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <input v-model="search" type="text" placeholder="Search.." class="form-control w-50">
                            <Link :href="route('admins.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                Create
                            </Link>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead class="thead-light">
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="admins && admins.data.length">
                                    <tr v-for="(user,index) in admins.data" :key="index">
                                        <td>
                                            <img class="rounded img-fluid avatar-img" :src="user.avatar" alt="" >
                                        </td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>
                                            <Link :href="route('admins.edit',user.id)" class="btn btn-primary mx-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                            </Link>
                                            <a @click="deleteStudent(user.id)" href="#"
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

                        <!-- Pagination  -->
                        <Pagination :links="admins.links" />
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
        admins: Object,
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
        deleteStudent(id) {
            if (confirm("Are you sure to delete?")) {
                Inertia.delete(route("admins.destroy", id));
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
