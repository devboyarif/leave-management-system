<template>

    <Head :title="__('Dashboard')" />
    <div class="row pt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-calendar-minus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Expense') }}</span>
                    <span class="info-box-number">{{ currencyPosition(summary.total_expense) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-hourglass"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Pending Request') }}</span>
                    <span class="info-box-number">{{ summary.total_pending_leaves }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Teams') }}</span>
                    <span class="info-box-number">{{ summary.total_teams }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Employees') }}</span>
                    <span class="info-box-number">{{ summary.total_employees }}</span>
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
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <!-- Pending Request  -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Pending Request') }}</h3>
                </div>
                <div class="card-body" v-if="!loading">
                    <div class="d-flex flex-wrap col-12">
                        <template v-if="pending_requests && summary.total_pending_leaves">
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
                                     <button @click="showDetails(request)" v-tooltip="__('Details')" class="btn btn-sm">
                                        <EyeIcon />
                                    </button>
                                </div>
                            </div>
                        </template>
                        <h6 class="text-center m-auto" v-else>{{ __('No Data Found') }}</h6>
                    </div>
                </div>
                <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
                </div>
            </div>

            <!-- Recent Approved Leaves -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Recent Approved Leaves') }}</h3>
                </div>
                <div class="card-body" v-if="!loading">
                    <div class="d-flex flex-wrap col-12">
                        <template v-if="recent_approved_requests && summary.total_approve_leaves">
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
                                <button @click="showDetails(request)" v-tooltip="__('Details')" class="btn btn-sm  pl-0">
                                    <EyeIcon />
                                </button>
                            </div>
                        </div>
                        </template>
                        <h6 class="text-center m-auto" v-else>{{ __('No Data Found') }}</h6>
                    </div>
                </div>
                <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
                </div>
            </div>

              <!-- Currently Subscribed -->
              <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Currently Subscribed') }}</h3>
                </div>
                <div class="card-body" v-if="!loading">
                    <div class="d-flex flex-wrap col-12">
                        <table class="table">
                            <tbody>
                                <tr v-if="subscribed_plan.plan">
                                    <th>{{ __('Plan') }}</th>
                                    <td>{{ subscribed_plan.plan.name }}</td>
                                </tr>
                                <tr v-if="subscribed_plan.plan">
                                    <th>{{ __('Subscription Type') }}</th>
                                    <td>
                                        <span v-if="subscribed_plan.plan.interval == 'custom_days'">
                                        {{ subscribed_plan.plan.custom_interval_days }} {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                        </span>
                                        <span v-else class="text-capitalize">{{ subscribed_plan.plan.interval }}</span>
                                    </td>
                                </tr>
                                <tr v-if="subscribed_plan.plan && subscribed_plan.plan.interval != 'lifetime'">
                                   <th>{{ __('Expiration Remaining') }}</th>
                                    <td>{{ subscribed_plan.remaining_days }}
                                    <span v-if="subscribed_plan.remaining_days != 'Lifetime'">
                                        {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                   <th width="40%">{{ __('Plan Features') }}</th>
                                    <td>
                                        <Feature :span-text="true" name="Unlimited Employees" :checked="!subscribed_plan.plan.plan_features.is_limited_employee"/>
                                        <Feature :span-text="true" name="Max Employees" :checked="true" :value="subscribed_plan.plan.plan_features.is_limited_employee ? subscribed_plan.plan.plan_features.max_employees : '∞'"/>
                                        <Feature :span-text="true" name="Max Teams" :checked="true" :value="subscribed_plan.plan.plan_features.max_teams"/>
                                        <Feature :span-text="true" name="Max Leave Types" :checked="true" :value="subscribed_plan.plan.plan_features.max_leave_types"/>
                                        <Feature :span-text="true" name="Custom Theme Look" :checked="subscribed_plan.plan.plan_features.custom_theme_look"/>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                     <div class="row justify-content-between">
                            <Link :href="route('company.billing')" class="btn btn-primary">{{ __('Upgrade Plan') }}</Link>
                       </div>
                </div>
                <div class="card-body mx-auto" v-else>
                    <Loading :messageShow="false" size="fa-2x" />
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
                                                <Link :href="route('company.employees.show',form.user_id)">
                                                    {{ form.name }}
                                                </Link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Leave Type') }}</td>
                                            <td width="70%"><a href="#">
                                                 <span :style="{ background: form.color, border: '2px solid '+form.color }" class="leave-type-color">
                                            {{ form.type }}
                                        </span>
                                            </a></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Date') }}</td>
                                            <td width="70%">{{ requestFor(form.start, form.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Total Days') }}</td>
                                            <td width="70%">{{ form.days }} {{ pluralize(form.days, 'Day') }}</td>
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
                                            <td width="50%">{{ form.reason }}</td>
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
import VueApexCharts from "vue3-apexcharts";
import Layout from "../Layout/Default.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import CheckIcon from "../Icons/CheckIcon.vue";
import dayjs from "dayjs";
import Feature from "../Admin/Plan/Feature.vue";

export default {
    components: {
        Layout,
        apexchart: VueApexCharts,
        FullCalendar,
        CheckIcon,
        Feature,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
            },
            summary: {},
            event_types: [],
            pending_requests: [],
            recent_approved_requests: [],
            subscribed_plan: {},
            form: {
                name: "",
                user_id: "",
                type: "",
                color: "",
                status: "",
                start: "",
                end: "",
                days: "",
                reason: "",
            },
            showModal: false,
            loading: true,
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
            this.form.user_id = request.user_id;
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
            this.$inertia.post(
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
            this.summary = response.data.summary;
            this.calendarOptions.events = response.data.events;
            this.event_types = response.data.event_types;
            this.pending_requests = response.data.pending_requests;
            this.recent_approved_requests =
                response.data.recent_approved_requests;
            this.subscribed_plan = response.data.subscribed_plan;
            this.loading = false;
        },
    },
    async mounted() {
        this.loading = true;
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
        padding: 1px 5px;
        font-weight: 500;
        color: #fff;
    }

    .modal-dialog {
        max-width: 1000px !important;
    }
</style>
