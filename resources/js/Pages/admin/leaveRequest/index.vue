<template>

    <Head :title="__('Company List')" />

    <div class="row justify-content-center" v-if="leaveRequests && leaveRequests.data.length">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Request List') }}</h3>
                        <div>
                            <Link :href="route('leaveRequests.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Create Leave Request') }}
                            </Link>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link v-if="form.company || form.status" :href="route('leaveRequests.index')" class="btn btn-danger ml-2">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                 <div class="card-body border-bottom d-flex justify-content-between" v-if="showFilter">
                        <div class=" w-25">
                            <label>Company</label>
                            <select class="form-control" v-model="form.company" @change="filterData">
                                <option value="">{{ __('All') }}</option>
                                <option :value="company.id" v-for="company in companies" :key="company.id">
                                    {{ company.user.name }}
                                </option>
                            </select>
                        </div>
                        <div class="ml-auto w-25">
                            <label>Status</label>
                            <select class="form-control" v-model="form.status" @change="filterData">
                                <option value="">{{ __('All') }}</option>
                                <option value="pending">{{ __('Pending') }}</option>
                                <option value="approved">{{ __('Approved') }}</option>
                                <option value="rejected">{{ __('Rejected') }}</option>
                            </select>
                        </div>
                    </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="leaveRequests && leaveRequests.data.length">
                                <tr v-for="(leaveRequest,index) in leaveRequests.data" :key="index">
                                    <td>
                                        <img v-if="leaveRequest.employee && leaveRequest.employee.user" :src="leaveRequest.employee.user.avatar" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        {{ leaveRequest.employee.user.name }}
                                        <template v-if="leaveRequest.company && leaveRequest.company.user">
                                        </template>
                                    </td>
                                    <td>
                                        <span :style="{ background: leaveRequest.leave_type.color, border: '2px solid '+leaveRequest.leave_type.color }" class="leave-type-color">
                                            {{ leaveRequest.leave_type.name }}
                                        </span>
                                    </td>
                                    <td v-if="leaveRequest.employee.team">
                                        <a href="#">{{ leaveRequest.employee.team.name }}</a>
                                    </td>
                                    <td>
                                        {{ startDate(leaveRequest.start) }} - {{ endDate(leaveRequest.end) }}

                                         (<span class="text-danger ml-1">
                                        {{ leaveRequest.days }} {{ pluralize(leaveRequest.days, __('Day')) }}
                                    </span>)

                                    </td>
                                    <td>
                                        <span class="toCapitalFirst badge" :class="getBadgeType(leaveRequest.status)">
                                            {{ leaveRequest.status }}
                                        </span>
                                    </td>
                                    <td class="d-flex">
                                       <Actions :leaveRequest="leaveRequest" />
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
                    <Pagination :links="leaveRequests.links" />
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" v-else>
        <div class="col-12 text-center mt-5 pt-5">
            <h3>{{ __('No Data Found') }}</h3>
        </div>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import Actions from "../../../Shared/Admin/LeaveRequest/Status.vue";
import dayjs from "dayjs";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        companies: Array,
        filters: Object || Array,
        leaveRequests: Array,
        filterRequest: Number,
    },
    components: {
        Pagination,
        Actions,
        Inertia,
    },
    data() {
        return {
            form: {
                company: this.filters.company,
                status: this.filters.status,
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
                    this.$inertia.delete(route("leaveRequests.destroy", id));
                }
            });
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminOrder", this.showFilter);
        },
        getBadgeType(status) {
            if (status == "pending") {
                return "badge-warning";
            } else if (status == "approved") {
                return "badge-success";
            } else {
                return "badge-danger";
            }
        },
        startDate(Date) {
            return dayjs(Date).format("DD MMM, YYYY");
        },
        endDate(Date) {
            return dayjs(Date).format("DD MMM, YYYY");
        },
        filterData() {
            Inertia.get(
                "leaveRequests",
                {
                    company: this.form.company,
                    status: this.form.status,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
    },
    mounted() {
        this.checkPagePermission("admin");
        this.showFilter = localStorage.getItem("adminOrder") == "true" ? true : false;
    },
};
</script>

<style scoped>
    .avatar-img {
        height: 60px;
        width: 60px;
        object-fit: cover;
    }

     .leave-type-color {
        border-radius: 30px;
        padding: 2px 5px;
            font-weight: 500;
        color: #fff;
    }
</style>
