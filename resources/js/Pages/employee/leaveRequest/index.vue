<template>

    <Head :title="__('Leave Requests')" />

    <div class="row justify-content-center pt-5">
        <div class="col-12">
            <div class="card">
                 <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Request List') }}</h3>
                        <div>
                            <Link :href="route('employee.leave.request.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                 {{ __('Apply for Leave') }}
                            </Link>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link :href="route('employee.leave.request.index')" class="btn btn-danger ml-2" v-if="filterForm.status || filterForm.leave_type">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom d-flex justify-content-between" v-if="showFilter">
                        <div class=" w-25">
                            <label>{{ __('Leave Type') }}</label>
                            <select class="form-control" v-model="filterForm.leave_type" @change="filterData">
                                <option value="">{{ __('All') }}</option>
                                <option :value="leave_type.id" v-for="leave_type in leaveTypes" :key="leave_type.id">
                                    {{ leave_type.name }}
                                </option>
                            </select>
                        </div>
                    <div class="ml-auto w-25">
                        <label>{{ __('Status') }}</label>
                        <select class="form-control" v-model="filterForm.status" @change="filterData">
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
                                        <span :style="{ background: leaveRequest.leave_type.color, border: '2px solid '+leaveRequest.leave_type.color }" class="leave-type-color">
                                            {{ leaveRequest.leave_type.name }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ startDate(leaveRequest.start_date) }} - {{ endDate(leaveRequest.end_date) }}

                                         (<span class="text-danger ml-1">
                                        {{ leaveRequest.days }} {{ pluralize(leaveRequest.days, 'Day') }}
                                    </span>)
                                    </td>
                                    <td>
                                        <span class="toCapitalFirst badge" :class="getBadgeType(leaveRequest.status)">
                                            {{ leaveRequest.status }}
                                        </span>
                                    </td>
                                    <td class="d-flex">
                                        <button @click="showDetails(leaveRequest)" v-tooltip="__('Details')" class="btn btn-sm">
                                                <EyeIcon/>
                                        </button>
                                        <template v-if="leaveRequest.status == 'pending'">
                                            <Link :href="route('employee.leave.request.edit', leaveRequest.id)" v-tooltip="__('Edit')" class="btn btn-sm">
                                            <EditIcon/>
                                            </Link>
                                        </template>
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

    <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog d-flex justify-content-center" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Leave Request Details') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">{{ __('Name') }}</td>
                                            <td width="70%">
                                                <a href="#">
                                                    <span :style="{ background: form.color, border: '2px solid '+form.color }" class="leave-type-color">
                                                    {{ form.type }}
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Date') }}</td>
                                            <td width="70%">{{ requestFor(form.start, form.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Total Days') }}</td>
                                            <td width="70%">{{  form.days }} {{ pluralize(form.days, 'Day') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Status') }}</td>
                                            <td width="70%">
                                                <span class="toCapitalFirst badge" :class="getBadgeType(form.status)">
                                                    {{ form.status }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Reason') }}</td>
                                            <td width="70%">{{ form.reason }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import dayjs from "dayjs";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        leaveRequests: Array,
        leaveTypes: Array,
        filters: Object,
    },
    components: {
        Pagination,
        Inertia,
    },
    data() {
        return {
            showModal: false,
            form: {
                type: "",
                color: "",
                status: "",
                start: "",
                end: "",
                days: "",
                reason: "",
            },

            showFilter: false,
            filterForm: {
                status: this.filters.status,
                leave_type: this.filters.leave_type,
            },
        };
    },
    methods: {
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
        requestFor(startDate, endDate) {
            const start = dayjs(startDate).format("DD MMM, YYYY");
            const end = dayjs(endDate).format("DD MMM, YYYY");

            return `${start} - ${end}`;
        },
        showDetails(request) {
            this.form.type = request.leave_type.name;
            this.form.color = request.leave_type.color;
            this.form.status = request.status;
            this.form.start = request.start;
            this.form.end = request.end;
            this.form.days = request.days;
            this.form.reason = request.reason;
            this.showModal = true;
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("employeeLeaveRequest", this.showFilter);
        },
        filterData() {
            Inertia.get(
                route("employee.leave.request.index"),
                {
                    status: this.filterForm.status,
                    leave_type: this.filterForm.leave_type,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
    },
    mounted() {
        this.checkPagePermission("employee");
        this.showFilter =
            localStorage.getItem("employeeLeaveRequest") == "true"
                ? true
                : false;
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

    .modal-dialog {
        max-width: 1000px !important;
    }
</style>
