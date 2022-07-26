<template>

    <Head :title="__('Leave Request List')" />

    <div class="row justify-content-center">
    {{ pluralize(5, 'apple') }}
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Request List') }}</h3>
                        <Link :href="route('company.leaveRequests.create')" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            {{ __('Create a new request') }}
                        </Link>
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
                                        <img :src="leaveRequest.employee.user.avatar" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        {{ leaveRequest.employee.user.name }}
                                        (<small v-tooltip="'Company Name'">{{ leaveRequest.company.user.name }}</small>)
                                    </td>
                                    <td>
                                        <span :style="{ background: leaveRequest.leave_type.color, border: '2px solid '+leaveRequest.leave_type.color }" class="leave-type-color">
                                            {{ leaveRequest.leave_type.name }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#">{{ leaveRequest.employee.team.name }}</a>
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
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";
import Actions from "../../../Shared/Company/LeaveRequest/Status.vue";
import dayjs from "dayjs";

export default {
    props: {
        leaveRequests: Array,
    },
    components: {
        Pagination,
        Inertia,
        Actions,
    },
    data() {
        return {};
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
    },
     mounted(){
        this.checkPagePermission('company')
    }
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
