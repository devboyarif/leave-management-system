<template>
    <Head :title="__('Employee List')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <input v-model="search" type="text" placeholder="Search.." class="form-control w-50">
                            <Link :href="route('employees.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Employee Create') }}
                            </Link>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>{{ __('Employee') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Action') }}</th>
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
                                            <Link :href="route('employees.edit',user.id)" v-tooltip="__('Employee Edit')" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(user.id)" v-tooltip="__('Employee Delete')" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h3>{{ __('No Data Found') }}</h3>
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
                    Inertia.delete(route("employees.destroy", id));
                }
            });
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
     mounted(){
        this.checkPagePermission('admin')
    }
};
</script>

<style scoped>
.avatar-img {
    height: 60px;
    width: 60px;
    object-fit: cover;
}
</style>
