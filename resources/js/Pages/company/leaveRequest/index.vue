<template>

    <Head :title="__('Leave Request List')" />

    <div class="row justify-content-center pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Request List') }}</h3>
                        <div>
                            <Link :href="route('company.leaveRequests.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                 {{ __('Create a new request') }}
                            </Link>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link v-if="form.status || form.leave_type" :href="route('company.leaveRequests.index')" class="btn btn-danger ml-2">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                 <div class="card-body border-bottom d-flex justify-content-between" v-if="showFilter">
                    <div class="w-25">
                        <label>{{ __('Leave Type') }}</label>
                        <select class="form-control" v-model="form.leave_type" @change="filterData">
                            <option value="">{{ __('All') }}</option>
                            <option :value="leave_type.id" v-for="leave_type in leaveTypes" :key="leave_type.id">
                                {{ leave_type.name }}
                            </option>
                        </select>
                    </div>
                    <div class="ml-auto w-25">
                        <label>{{ __('Status') }}</label>
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
                                <th>{{ __('Team') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="leaveRequests && leaveRequests.data.length">
                                <tr v-for="(leaveRequest,index) in leaveRequests.data" :key="index">
                                    <td>
                                        <Link :href="route('company.employees.show',leaveRequest.employee.user_id)">
                                            <img :src="leaveRequest.employee.user.avatar" alt="img"
                                            class="img-circle img-size-32 mr-2">
                                            {{ leaveRequest.employee.user.name }}
                                        </Link>
                                    </td>
                                    <td>
                                        <span :style="{ background: leaveRequest.leave_type.color, border: '2px solid '+leaveRequest.leave_type.color }" class="leave-type-color">
                                            {{ leaveRequest.leave_type.name }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ leaveRequest.employee.team.name }}
                                    </td>
                                    <td>
                                        {{ startDate(leaveRequest.start) }} - {{ endDate(leaveRequest.end) }}

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
                                       <Actions :leaveRequest="leaveRequest" />
                                       <button @click="showDetails(leaveRequest)" v-tooltip="__('Details')" class="btn btn-sm">
                                            <EyeIcon/>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="20" class="text-center">
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
                                            <td width="30%">{{ __('Employee') }}</td>
                                            <td width="70%">
                                                <Link :href="route('company.employees.show',detailForm.user_id)">
                                                    {{ detailForm.employee }}
                                                </Link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Leave Type') }}</td>
                                            <td width="70%">
                                                <a href="#">
                                                    <span :style="{ background: detailForm.color, border: '2px solid '+detailForm.color }" class="leave-type-color">
                                                    {{ detailForm.type }}
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Date') }}</td>
                                            <td width="70%">{{ requestFor(detailForm.start, detailForm.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Total Days') }}</td>
                                            <td width="70%">{{ detailForm.days }} {{ pluralize(detailForm.days, 'Day') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Status') }}</td>
                                            <td width="70%">
                                                <span class="toCapitalFirst badge" :class="getBadgeType(detailForm.status)">
                                                    {{ detailForm.status }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Reason') }}</td>
                                            <td width="50%">{{ detailForm.reason }}</td>
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
import Actions from "../../../Shared/Company/LeaveRequest/Status.vue";
import dayjs from "dayjs";

export default {
    props: {
        leaveRequests: Array,
        leaveTypes: Array,
        filters: Object,
    },
    components: {
        Pagination,
        Actions,
    },
    data() {
        return {
            showModal: false,
            showFilter: false,
            form: {
                status: this.filters.status,
                leave_type: this.filters.leave_type,
            },

            detailForm: {
                type: "",
                color: "",
                status: "",
                start: "",
                end: "",
                days: "",
                reason: "",
                user_id: "",
                employee: "",
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
        startDate(date) {
            return dayjs(date).format("DD MMM, YYYY");
        },
        endDate(date) {
            return dayjs(date).format("DD MMM, YYYY");
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("companyLeaveRequestList", this.showFilter);
        },
        filterData() {
            this.$inertia.get(
                route("company.leaveRequests.index"),
                {
                    status: this.form.status,
                    leave_type: this.form.leave_type,
                    team: this.form.team,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
        showDetails(request) {
            this.detailForm.type = request.leave_type.name;
            this.detailForm.color = request.leave_type.color;
            this.detailForm.status = request.status;
            this.detailForm.start = request.start;
            this.detailForm.end = request.end;
            this.detailForm.days = request.days;
            this.detailForm.reason = request.reason;
            this.detailForm.user_id = request.employee.user_id;
            this.detailForm.employee = request.employee.user.name;
            this.showModal = true;
        },
        requestFor(startDate, endDate) {
            const start = dayjs(startDate).format("DD MMM, YYYY");
            const end = dayjs(endDate).format("DD MMM, YYYY");

            return `${start} - ${end}`;
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
    },
    mounted() {
        this.checkPagePermission("owner");
        this.showFilter =
            localStorage.getItem("companyLeaveRequestList") == "true"
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
