<template>

    <Head title="Company List" />

    <div class="row justify-content-center" v-if="leaveRequests && leaveRequests.data.length">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Leave Request List</h3>
                        <Link :href="route('company.leaveRequests.create')" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Create a new request
                        </Link>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Team</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                        {{ startDate(leaveRequest.start_date) }} - {{ endDate(leaveRequest.end_date) }}

                                         (<span class="text-danger ml-1">
                                        {{ leaveRequest.days }} Day
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
                                    <h3>No User Found</h3>
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
            <h3>Please select a company</h3>
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
        deleteCompany(id) {
            if (confirm("Are you sure to delete?")) {
                Inertia.delete(route("company.leaveRequests.destroy", id));
            }
        },
        getCompanyWiseRequest() {
            this.filterForm.get(route("leaveRequests.index"));
            console.log(this.filterForm);
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
