<template>

    <Head title="Employee Dashboard" />
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Leave Request</span>
                    <span class="info-box-number">50</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">Pending Request</span>
                    <span class="info-box-number">50</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Teams</span>
                    <span class="info-box-number">50</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Employees</span>
                    <span class="info-box-number">50</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8 shadow">
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

            <div class="card">
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
                                    <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png"
                                        alt="Product 1" class="img-circle img-size-32 mr-2">
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
                                    <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png"
                                        alt="Product 1" class="img-circle img-size-32 mr-2">
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
                                    <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png"
                                        alt="Product 1" class="img-circle img-size-32 mr-2">
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
                                    <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png"
                                        alt="Product 1" class="img-circle img-size-32 mr-2">
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
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Leave Balance</h3>
                        <Link :href="route('employee.leave.request')" class="btn btn-primary btn-sm">Apply for Leave</Link>
                    </div>
                </div>
                <div class="card-body">
                    <div v-for="(leave_balance, index) in leave_balances" :key="index">
                        <PieChart :title="leave_balance.title" :series="leavePercentage(leave_balance)"/>
                        <ul class="list-group list-group-horizontal my-2 d-flex justify-content-center">
                            <li class="list-group-item">
                                Total - <span>{{ leave_balance.total_days }}</span>
                            </li>
                            <li class="list-group-item">
                                Used - <span>{{ leave_balance.used_days }}</span>
                            </li>
                            <li class="list-group-item">
                                Remaining - <span>{{ leave_balance.remaining_days }}</span>
                            </li>
                        </ul>
                        <hr v-if="index+1 != leave_balances.length">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../Layout/Default.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

import PieChart from "../Chart/PieChart.vue";

export default {
    components: {
        Layout,
        FullCalendar,
        PieChart,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
            },
            event_types: [],
            leave_balances: [],
        };
    },
    methods: {
        leavePercentage(leave_balance) {
            return [
                leave_balance.user_percentage,
                leave_balance.remaining_percentage,
            ];
        },
    },
    async mounted() {
        let response = await axios.get(route("employee.dashboard"));
        this.calendarOptions.events = response.data.events;
        this.event_types = response.data.event_types;
        this.leave_balances = response.data.leave_balances;

        console.log(response.data.leave_balances);
    },
};
</script>

<style scoped>
    .event-size {
        padding: 0px 10px !important;
        border-radius: 5px !important;
    }
</style>
