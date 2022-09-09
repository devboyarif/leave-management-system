<template>

    <Head :title="__('Dashboard')" />
    <div class="row pt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Leave Request') }}</span>
                    <span class="info-box-number">{{ summary.total_leaves }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">{{ __('Total Pending Request') }}</span>
                    <span class="info-box-number">{{ summary.total_pending_leaves }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Approved Request') }}</span>
                    <span class="info-box-number">{{ summary.total_approved_leaves }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-file-pen"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Leave Type') }}</span>
                    <span class="info-box-number">{{ summary.total_leave_types }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Calendar') }}</h3>
                </div>
               <template v-if="!loading">
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
               </template>
                <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
                </div>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                     <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Pending Leave Request') }}</h3>
                        <Link v-tooltip="'Show all leave requests'" :href="route('employee.leave.request.index')" class="btn btn-primary btn-sm">
                            <i class="fa-regular fa-eye"></i>
                            {{ __('Show all') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body table-responsive p-0" v-if="!loading">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="pending_leave_requests && pending_leave_requests.length">
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
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    </td>
                                    <td>
                                        <Link :href="route('employee.leave.request.edit', leave_request.id)" v-tooltip="__('Edit Leave Request')" class="btn btn-sm">
                                            <EditIcon/>
                                        </Link>
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
                </div>
                <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
                </div>
            </div>
        </div>

        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Balance') }}</h3>
                        <Link v-tooltip="__('Apply for Leave')" :href="route('employee.leave.request.create')" class="btn btn-danger btn-sm">
                            <i class="fa-regular fa-calendar-check"></i>
                            {{ __('Apply for Leave') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body" v-if="!loading">
                    <template v-if="leave_balances && leave_balances.length">
                        <div v-for="(leave_balance, index) in leave_balances" :key="index">
                            <PieChart :title="leave_balance.title" :series="leavePercentage(leave_balance)"/>
                            <ul class="list-group list-group-horizontal my-2 d-flex justify-content-center">
                                <li class="list-group-item">
                                    {{ __('Total') }} - <span>{{ leave_balance.total_days }}</span>
                                </li>
                                <li class="list-group-item">
                                    {{ __('Used') }} - <span>{{ leave_balance.used_days }}</span>
                                </li>
                                <li class="list-group-item">
                                    {{ __('Remaining') }} - <span>{{ leave_balance.remaining_days }}</span>
                                </li>
                            </ul>
                            <hr v-if="index+1 != leave_balances.length">
                        </div>
                    </template>
                    <div class="text-center">
                        <h6>{{ __('No Data Found') }}</h6>
                    </div>
                </div>
                 <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
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
            summary: {},
            pending_leave_requests: [],
            loading: true,
        };
    },
    methods: {
        leavePercentage(leave_balance) {
            return [
                leave_balance.user_percentage,
                leave_balance.remaining_percentage,
            ];
        },
        async loadData() {
            let response = await axios.get(route("employee.dashboard"));
            this.calendarOptions.events = response.data.events;
            this.event_types = response.data.event_types;
            this.leave_balances = response.data.leave_balances;
            this.summary = response.data.summary;
            this.pending_leave_requests = response.data.pending_leave_requests;
            this.loading = false;
        },
    },
    async mounted() {
        await this.loadData();
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
