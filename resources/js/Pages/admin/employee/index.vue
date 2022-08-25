<template>
    <Head :title="__('Employee List')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                           <h3 class="card-title">{{ __('Employee List') }}</h3>
                           <div>
                             <Link :href="route('employees.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Employee Create') }}
                            </Link>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link :href="route('employees.index')" class="btn btn-danger ml-2" v-if="form.search.length || form.company">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                           </div>
                        </div>
                    </div>
                     <div class="card-body border-bottom d-flex justify-content-between" v-if="showFilter">
                        <div class="w-25">
                            <label>{{ __('Search') }}</label>
                            <input v-model="form.search" type="text" placeholder="Search..." class="form-control">
                        </div>
                        <div class="ml-auto w-15">
                            <label>{{ __('Company') }}</label>
                            <select class="form-control" v-model="form.company">
                                <option value="">{{ __('All') }}</option>
                                <option :value="company.id" v-for="company in companies" :key="company.id">
                                    {{ company.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>{{ __('Employee') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="employees && employees.data.length">
                                    <tr v-for="(employee,index) in employees.data" :key="index">
                                        <td>
                                            <Link :href="route('employees.show',employee.user_id)">
                                                <img :src="employee.avatar" alt="img"
                                                class="img-circle img-size-32 mr-2">
                                                <span v-html="employee.name"></span>
                                            </Link>
                                        </td>
                                        <td v-html="employee.email"></td>
                                        <td>{{ employee.phone ? employee.phone: '-' }}</td>
                                        <td>{{ employee.company }}</td>
                                        <td class="d-flex">
                                            <Link :href="route('employees.show',employee.user_id)" v-tooltip="'Details'" class="btn btn-sm pl-0">
                                                <EyeIcon/>
                                            </Link>
                                            <Link :href="route('employees.edit',employee.user_id)" v-tooltip="__('Employee Edit')" class="btn btn-sm">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(employee.user_id)" v-tooltip="__('Employee Delete')" class="btn btn-sm">
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
        companies: Array,
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
                company: this.filters.company,
            },
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
                    this.$inertia.delete(route("employees.destroy", id));
                }
            });
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminEmployee", this.showFilter);
        },
    },
    watch: {
        "form.search": debounce((value) => {
            Inertia.get(
                "employees",
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
        "form.company": debounce((value) => {
            Inertia.get(
                "employees",
                { company: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
    },
    mounted() {
        this.checkPagePermission("admin");
        this.showFilter = localStorage.getItem("adminEmployee") == "true" ? true : false;
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
