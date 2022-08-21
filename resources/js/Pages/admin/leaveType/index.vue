<template>
    <Head :title="__('Leave Type List')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ __('Leave Type List') }}</h3>
                            <div>
                                <Link :href="route('leaveTypes.create')" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i>
                                   {{ __('Create Leave Request') }}
                                </Link>
                                <button class="btn btn-secondary ml-2" @click="filteringData">
                                    <i class="fa-solid fa-filter"></i>
                                    &nbsp;
                                    <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                    <span v-else>{{ __('Hide Filter') }}</span>
                                </button>
                                 <Link :href="route('leaveTypes.index')" class="btn btn-danger ml-2" v-if="company">
                                    <i class="fa-solid fa-times"></i>
                                    {{ __('Clear') }}
                                </Link>
                            </div>
                        </div>
                    </div>
                     <div class="card-body border-bottom" v-if="showFilter">
                        <label>Company</label>
                         <select v-model="company" class="form-control w-25">
                            <option value="">{{ __('All') }}</option>
                            <option v-for="company in companies" :key="company.id" :value="company.id">
                                {{ company.user.name }}
                            </option>
                        </select>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Color') }}</th>
                                    <th>{{ __('Leave Balance') }}</th>
                                    <th>{{ __('Options') }}</th>
                                    <th>{{ __('Action') }}</th>
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
                                            {{ leave_type.balance }} {{ pluralize(leave_type.balance, 'Day') }}
                                        </td>
                                        <td>
                                            <span v-if="leave_type.auto_approve" class="badge badge-pill badge-info mx-1">
                                                {{ __('Allow auto approve') }}
                                            </span>
                                            <span class="badge badge-pill mx-1" :class="leave_type.status ? 'badge-success':'badge-danger'">
                                                <span v-if="leave_type.status">{{ __('Active') }}</span>
                                                <span v-else>{{ __('Inactive') }}</span>
                                            </span>
                                        </td>
                                        <td class="d-flex">
                                            <Link :href="route('leaveTypes.edit',leave_type.id)" v-tooltip="__('Edit')" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(leave_type.id)" v-tooltip="__('Delete')" class="btn btn-sm">
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
        companies: Array,
        filters: Object || Array,
    },
    components: {
        Pagination,
        Inertia,
    },
    data() {
        return {
            company: this.filters.company ?? "",
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
                    this.$inertia.delete(route("leaveTypes.destroy", id));
                }
            });
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminLeaveType", this.showFilter);
        },
    },
    watch: {
        company: debounce((value) => {
            Inertia.get(
                "leaveTypes",
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
        this.showFilter =
            localStorage.getItem("adminLeaveType") == "true" ? true : false;
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
