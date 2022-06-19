<template>

    <Head title="Employee Dashboard" />
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Leave Request</span>
                    <span class="info-box-number">{{ summery.total_leaves }}</span>
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
                <div class="card-header">
                    <h3 class="card-title"></h3>

                     <div class="d-flex justify-content-between">
                        <h3 class="card-title">Pending Leave Request</h3>
                        <Link v-tooltip="'Show all leave requests'" :href="route('employee.leave.request.index')" class="btn btn-primary btn-sm">
                            <i class="fa-regular fa-eye"></i>
                            Show all
                        </Link>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="leave_request in pending_leave_requests" :key="leave_request.id">
                                <td>
                                    <span :style="{ background: leave_request.color, border: '2px solid '+leave_request.color }" class="leave-type-color">
                                        {{ leave_request.name }}
                                    </span>
                                </td>
                                <td>{{ leave_request.start }} - {{ leave_request.end }} (<span class="text-danger ml-1">
                                        {{ leave_request.days }} {{ pluralize(leave_request.days, 'Day') }}
                                    </span>)</td>
                                <td>
                                    <span class="badge badge-warning">Pending</span>
                                </td>
                                <td>
                                    <Link :href="route('employee.leave.request.edit', leave_request.id)" v-tooltip="'Edit Request'" class="btn btn-sm">
                                        <EditIcon/>
                                    </Link>
                                    <button @click="deleteData(leave_request.id)" v-tooltip="'Delete Request'" class="btn btn-sm">
                                        <DeleteIcon/>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Leave Balance</h3>
                        <Link v-tooltip="'Apply for leave new request'" :href="route('employee.leave.request.create')" class="btn btn-danger btn-sm">
                            <i class="fa-regular fa-calendar-check"></i>
                            Apply for Leave
                        </Link>
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
            summery: {},
            pending_leave_requests: [],
        };
    },
    methods: {
        leavePercentage(leave_balance) {
            return [
                leave_balance.user_percentage,
                leave_balance.remaining_percentage,
            ];
        },
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
                    Inertia.delete(route("employee.leave.request.delete", id));
                }
            });
        },
    },
    async mounted() {
        let response = await axios.get(route("employee.dashboard"));
        this.calendarOptions.events = response.data.events;
        this.event_types = response.data.event_types;
        this.leave_balances = response.data.leave_balances;
        this.summery = response.data.summery;
        this.pending_leave_requests = response.data.pending_leave_requests;

        console.log(response.data.leave_balances);
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
        padding: 2px 5px;
            font-weight: 500;
        color: #fff;
    }
</style>
