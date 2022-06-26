<template>

    <Head title="Company Dashboard" />
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Expense</span>
                    <span class="info-box-number">$99999999</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">Pending Request</span>
                    <span class="info-box-number">{{ summery.total_pending_leaves }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Teams</span>
                    <span class="info-box-number">{{ summery.total_teams }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Employees</span>
                    <span class="info-box-number">{{ summery.total_employees }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Calendar</h3>
                </div>
                <div class="card-body">
                    <FullCalendar :options="calendarOptions" />
                </div>
                <div class="card-footer row justify-content-between">
                    <span v-for="(event_type,index) in event_types" :key="index">
                        <span class="mr-2 event-size" :style="{
                                backgroundColor: event_type.color,
                                border: '2px solid '+ event_type.color
                            }"></span>
                        {{ event_type.name }}
                    </span>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Pending Request</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <template v-if="pending_requests && pending_requests.length">
                            <div v-for="request in pending_requests" :key="request.id"
                                class="col-12 holidayCont officalHCont d-flex justify-content-between align-items-center main-user-fields">
                                <div class="mt-4">
                                    <h6><strong>{{ request.title }}</strong>
                                        <span class="text-danger ml-1">
                                            {{ request.days }} {{ pluralize(request.days, 'Day') }}
                                        </span>
                                    </h6>
                                    <h6 class="d-flex align-items-center">
                                        <span class="m-widget4__sub">
                                            <span class="m-widget4__sm-text mr-1">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ startDate(request.start) }}
                                            </span>
                                            <span class="m-widget4__sm-text ml-1">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ endDate(request.end) }}
                                            </span>
                                        </span>
                                    </h6>
                                    <span :style="{ background: request.color, border: '2px solid '+request.color }"
                                        class="leave-type-color" v-tooltip="'Leave Type'">
                                        {{ request.type }}
                                    </span>
                                </div>
                                <div>
                                    <button @click="statusChange('approved', request.id)" v-tooltip="'Accept Request'" class="btn btn-sm">
                                        <CheckIcon />
                                    </button>
                                    <button @click="statusChange('rejected', request.id)" v-tooltip="'Reject Request'" class="btn btn-sm px-0">
                                        <CrossIcon />
                                    </button>
                                     <button @click="showDetails(request)" v-tooltip="'Show Request Details'" class="btn btn-sm">
                                        <EyeIcon />
                                    </button>
                                </div>
                            </div>
                        </template>
                        <h6 class="text-center m-auto" v-else>No pending leaves found</h6>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Recent Approved Leaves</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <div v-for="request in recent_approved_requests" :key="request.id"
                            class="col-12 holidayCont officalHCont d-flex justify-content-between align-items-center main-user-fields">
                            <div class="mt-4">
                                <h6><strong>{{ request.title }}</strong>
                                    <span class="text-danger ml-1">
                                        {{ request.days }} {{ pluralize(request.days, 'Day') }}
                                    </span>
                                </h6>
                                <h6 class="d-flex align-items-center">
                                    <span class="m-widget4__sub">
                                        <span class="m-widget4__sm-text mr-1">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ startDate(request.start) }}
                                        </span>
                                        <span class="m-widget4__sm-text ml-1">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ endDate(request.end) }}
                                        </span>
                                    </span>
                                </h6>
                                <span :style="{ background: request.color, border: '2px solid '+request.color }"
                                    class="leave-type-color" v-tooltip="'Leave Type'">
                                    {{ request.type }}
                                </span>
                            </div>
                            <div>
                                <button @click="showDetails(request)" v-tooltip="'Show Request Details'" class="btn btn-sm  pl-0">
                                    <EyeIcon />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Leave Request Details
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">Employee Name</td>
                                            <td width="70%">
                                                {{ form.name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Type Name</td>
                                            <td width="70%"><a href="#">
                                                 <span :style="{ background: form.color, border: '2px solid '+form.color }" class="leave-type-color">
                                            {{ form.type }}
                                        </span>
                                            </a></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Date</td>
                                            <td width="70%">{{ requestFor(form.start, form.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Total Days</td>
                                            <td width="70%">{{ form.days }} {{ pluralize(form.days, 'Day') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Status</td>
                                            <td width="70%">
                                                <span class="toCapitalFirst badge" :class="getBadgeType(form.status)">
                                                    {{ form.status }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Reason</td>
                                            <td width="50%">{{ form.reason }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";
import Layout from "../Layout/Default.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import CheckIcon from "../Icons/CheckIcon.vue";
import dayjs from "dayjs";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Layout,
        apexchart: VueApexCharts,
        FullCalendar,
        CheckIcon,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
            },
            summery: {},
            event_types: [],
            pending_requests: [],
            recent_approved_requests: [],
            form: {
                name: "",
                type: "",
                color: "",
                status: "",
                start: "",
                end: "",
                days: "",
                reason: "",
            },
            showModal: false,
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
            this.form.name = request.title;
            this.form.type = request.type;
            this.form.color = request.color;
            this.form.status = request.status;
            this.form.start = request.start;
            this.form.end = request.end;
            this.form.days = request.days;
            this.form.reason = request.reason;
            this.showModal = true;
        },
        statusChange(status, id) {
            Inertia.post(
                route("company.leaveRequests.status"),
                {
                    id: id,
                    status: status,
                },
                {
                    onSuccess: () => {
                        this.loadData();
                        preserveScroll = false;
                    },
                }
            );
        },
        async loadData() {
            let response = await axios.get(route("company.dashboard"));
            this.summery = response.data.summery;
            this.calendarOptions.events = response.data.events;
            this.event_types = response.data.event_types;
            this.pending_requests = response.data.pending_requests;
            this.recent_approved_requests =
                response.data.recent_approved_requests;
        },
    },
    async mounted() {
        await this.loadData();
        console.log(this.event_types);
    },
};
</script>

<style scoped>
    .event-size {
        padding: 0px 10px !important;
        border-radius: 5px !important;
    }

    .leave-type-color {
        border-radius: 30px;
        padding: 1px 5px;
        font-weight: 500;
        color: #fff;
    }
</style>
