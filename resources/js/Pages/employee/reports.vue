<template>

    <Head :title="__('Leave History')" />

     <div class="row justify-content-center pt-5">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="" class="mr-sm-2">{{ __('Date Range') }}</label>
                <select class="custom-select mr-sm-2" v-model="form.date_type" :class="{'is-invalid':errors.date_type}">
                    <option value="" class="d-none">{{ __('Select Range') }}</option>
                    <option value="this_week">{{ __('This Week') }}</option>
                    <option value="last_week">{{ __('Last Week') }}</option>
                    <option value="this_month">{{ __('This Month') }}</option>
                    <option value="last_month">{{ __('Last Month') }}</option>
                    <option value="last_6_month">{{ __('Last 6 Month') }}</option>
                    <option value="this_year">{{ __('This Year') }}</option>
                    <option value="last_year">{{ __('Last Year') }}</option>
                    <option value="custom_date">{{ __('Custom Data') }}</option>
                    <option value="custom_range_date">{{ __('Custom Date Range') }}</option>
                </select>
                <span v-if="errors.date_type" class="invalid-feedback">{{ errors.date_type && errors.date_type[0] }}</span>
            </div>
        </div>
        <div class="col-lg-2" v-if="showSingleDate">
            <div class="form-group">
                <label for="" class="mr-sm-2">{{ __('Select Custom Date') }}</label>
                <Datepicker v-model="form.custom_date" :enableTimePicker="false"
                    @update:modelValue="handleCustomDate" :class="{'is-invalid':errors.custom_date}" :placeholder="__('Select Date')" />
                <span v-if="errors.custom_date" class="invalid-feedback">{{ errors.custom_date && errors.custom_date[0] }}</span>
            </div>
        </div>
        <div class="col-lg-2" v-if="showDateRange">
            <div class="form-group">
                <label for="" class="mr-sm-2">{{ __('Select Custom Range') }}</label>
                <Datepicker v-model="form.custom_date_range" :enableTimePicker="false"
                    @update:modelValue="handleCustomRangeDate" :class="{'is-invalid':errors.custom_start_date || errors.custom_end_date}" :placeholder="__('Select Date Range')" range multiCalendars />
                <span v-if="errors.custom_start_date" class="invalid-feedback">This field is required</span>
                <span v-else-if="errors.custom_end_date" class="invalid-feedback">The end date selection is not correct</span>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <button @click="getReport" type="button" class="btn btn-primary" style="margin-top:30px">
                    <Loading v-if="buttonLoading"/>
                    <span v-else>
                        <i class="fa-solid fa-check mr-1"></i>
                        {{ __('Get Report') }}
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card">
                  <div class="card-header">
                     <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave History') }}</h3>
                        <Link :href="route('company.reports.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                            {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body">
                     <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th width="30%">{{ __('Reason') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="leave_requests && leave_requests.length">
                                <tr v-for="(leaveRequest,index) in leave_requests" :key="index">
                                    <td>
                                        <span :style="{ background: leaveRequest.leave_type.color, border: '2px solid '+leaveRequest.leave_type.color }" class="leave-type-color">
                                            {{ leaveRequest.leave_type.name }}
                                        </span>
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
                                    <td>
                                        {{ leaveRequest.reason }}
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
                </div>
            </div>
        </div>
    </div>

</template>


<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import dayjs from "dayjs";
import axios from 'axios';

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            form: this.$inertia.form({
                date_type: "",
                custom_date: '',
                custom_start_date: '',
                custom_end_date: '',
            }),

            leave_requests: [],

            showSingleDate: false,
            showDateRange: false,
            buttonLoading: false,

            errors: {},
        };
    },
    methods: {
        handleCustomDate(date) {
            const formatTime = dayjs(date).format("YYYY-MM-DD");
            this.form.custom_date = formatTime;
        },
        handleCustomRangeDate(date) {
            const array_date = Object.keys(date);
            const startDate = date[array_date[0]];
            const endDate = date[array_date[1]];

            if (!endDate) {
                this.errors.custom_end_date = ['The end date selection is not correct'];
            } else {
                this.errors.custom_end_date = null;
            }

            this.form.custom_start_date = dayjs(startDate).format("YYYY-MM-DD")
            this.form.custom_end_date = dayjs(endDate).format("YYYY-MM-DD")
        },
        async getReport(){
            try {
                this.buttonLoading = true;
                this.errors = {}
                let response = await axios.get(route('employee.reports.details'), {
                    params: {
                        date_type: this.form.date_type,
                        custom_date: this.form.custom_date,
                        custom_start_date: this.form.custom_start_date,
                        custom_end_date: this.form.custom_end_date,
                    }
                })

                this.leave_requests = response.data;
                this.buttonLoading = false;
            } catch (error) {
                this.buttonLoading = false;
                this.errors = error.response.data.errors
            }
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
        startDate(date) {
            return dayjs(date).format("DD MMM, YYYY");
        },
        endDate(date) {
            return dayjs(date).format("DD MMM, YYYY");
        },
    },
    watch:{
        "form.date_type": function(val){
            if (val == 'custom_date') {
                this.showSingleDate = true;
                this.showDateRange = false;
            }else if(val == 'custom_range_date'){
                this.showSingleDate = false;
                this.showDateRange = true;
            }else{
                this.showSingleDate = false;
                this.showDateRange = false;
            }
        },
    },
        mounted(){
        this.checkPagePermission('employee')
    }
};
</script>

<style scoped>
 .leave-type-color {
        border-radius: 30px;
        padding: 2px 5px;
            font-weight: 500;
        color: #fff;
    }
</style>
