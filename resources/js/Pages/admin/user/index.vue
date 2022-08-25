<template>
    <Head :title="__('Admin List')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Admin List') }}</h3>
                        <div>
                            <Link :href="route('admins.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Admin Create') }}
                            </Link>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link :href="route('admins.index')" class="btn btn-danger ml-2" v-if="search && search.length">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom" v-if="showFilter">
                    <label>{{ __('Search') }}</label>
                    <input v-model="search" type="text" placeholder="Search.." class="form-control w-25">
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="admins && admins.data.length">
                                <tr v-for="(user,index) in admins.data" :key="index">
                                    <td>
                                        <Link :href="route('admins.show',user.id)">
                                            <img :src="user.avatar" alt="img"
                                            class="img-circle img-size-32 mr-2">
                                            <span v-html="user.name"></span>
                                        </Link>
                                    </td>
                                    <td>
                                        <span v-html="user.email"></span>
                                    </td>
                                    <td class="d-flex">
                                        <Link :href="route('admins.show',user.id)" v-tooltip="'Details'" class="btn btn-sm pl-0">
                                            <EyeIcon/>
                                        </Link>
                                        <Link :href="route('admins.edit',user.id)" v-tooltip="'Edit'" class="btn btn-sm">
                                            <EditIcon/>
                                        </Link>
                                        <button @click="deleteData(user.id)" v-tooltip="'Delete'" class="btn btn-sm">
                                            <DeleteIcon/>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h6>{{ __('No Data Found') }}</h6>
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
import Pagination from "../../../Shared/Pagination.vue";
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
            showFilter: false,
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
                    this.$inertia.delete(route("admins.destroy", id));
                }
            });
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminUser", this.showFilter);
        },
    },
    watch: {
        search: debounce((value) => {
            Inertia.get(
                "admins",
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
    },
    mounted() {
        this.checkPagePermission("admin");
        this.showFilter = localStorage.getItem("adminUser") == "true" ? true : false;
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
