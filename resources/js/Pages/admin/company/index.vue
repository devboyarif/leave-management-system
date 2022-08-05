<template>
    <Head :title="__('Company List')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                     <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ __('Company List') }}</h3>
                            <div>
                                <Link :href="route('companies.create')" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i>
                                    {{ __('Company Create') }}
                                </Link>
                                <button class="btn btn-secondary ml-2" @click="filteringData">
                                    <i class="fa-solid fa-filter"></i>
                                </button>
                                <Link :href="route('companies.index')" class="btn btn-danger ml-2" v-if="form.search.length || form.country.length">
                                    <i class="fa-solid fa-times"></i>
                                    {{ __('Clear') }}
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom d-flex justify-content-between" v-if="showFilter">
                        <div class="w-25">
                            <label>Search</label>
                            <input v-model="form.search" type="text" placeholder="Search..." class="form-control">
                        </div>
                        <div class="ml-auto w-15">
                            <label>Country</label>
                            <select class="form-control" v-model="form.country">
                                <option value="">{{ __('All') }}</option>
                                <option :value="country.id" v-for="country in countries" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="companies && companies.data.length">
                                    <tr v-for="(user,index) in companies.data" :key="index">
                                        <td>
                                            <img :src="user.avatar" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            <span v-html="user.name"></span>
                                        </td>
                                        <td v-html="user.email"></td>
                                        <td>{{ user.country }}</td>
                                        <td class="d-flex">
                                            <Link :href="route('companies.edit',user.id)" v-tooltip="__('Company Edit')" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteCompany(user.id)" v-tooltip="__('Company Delete')" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h5>{{ __('No Data Found') }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination  -->
                        <Pagination :links="companies.links" />
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
        companies: Object,
        countries: Array,
        filters: Object || Array,
    },
    components: {
        Pagination,
        Inertia,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                country: this.filters.country,
            },
            showFilter: false,
        };
    },
    methods: {
        deleteCompany(id) {
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
                    this.$inertia.delete(route("companies.destroy", id));
                }
            });
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("showFilter", this.showFilter);
        },
    },
    watch: {
        "form.search": debounce((value) => {
            Inertia.get(
                "companies",
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
        "form.country": debounce((value) => {
            Inertia.get(
                "companies",
                { country: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
    },
    mounted() {
        this.checkPagePermission("admin");
        if (localStorage.getItem("showFilter")) {
            this.showFilter = localStorage.getItem("showFilter");
        }
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
