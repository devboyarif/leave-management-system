<template>

    <Head title="Company Dashboard" />
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Expense</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">Pending Request</span>
                    <span class="info-box-number">4</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Teams</span>
                    <span class="info-box-number">5</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Employees</span>
                    <span class="info-box-number">5</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
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
            <!-- /.card -->

            <!-- <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Products</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                        <small class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            12%
                                        </small>
                                        12,000 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td>
                                        <small class="text-warning mr-1">
                                            <i class="fas fa-arrow-down"></i>
                                            0.5%
                                        </small>
                                        123,234 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td>
                                        <small class="text-danger mr-1">
                                            <i class="fas fa-arrow-down"></i>
                                            3%
                                        </small>
                                        198 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Perfect Item
                                        <span class="badge bg-danger">NEW</span>
                                    </td>
                                    <td>$199 USD</td>
                                    <td>
                                        <small class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            63%
                                        </small>
                                        87 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Request</h3>
                </div>
                <div class="card-body">
                    <!-- <pre>
                            {{ pending_requests }}
                        </pre> -->
                    <div class="d-flex flex-wrap col-12">
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
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
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
                        <div class="modal-content">
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

            series: [80, 20],
            chartOptions: {
                chart: {
                    width: 380,
                    type: "pie",
                },
                colors: ["#2A8737", "#F23D4E"],
                labels: ["Present", "Absent"],
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    },
                ],
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
