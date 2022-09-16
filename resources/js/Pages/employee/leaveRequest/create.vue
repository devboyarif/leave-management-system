<template>

    <Head :title="__('Create Leave Request')" />
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Create Leave Request') }}</h3>
                        <Link :href="route('employee.leave.request.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                       {{ __('Leave Request List') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6 offset-lg-2">
                        <form @submit.prevent="sendData">
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <Label :name="__('Leave Type')" />
                                    <select v-model="form.leave_type_id" id="company" class="form-control"
                                        :class="{'is-invalid':form.errors.leave_type_id}" @change="checkLeaveTypeBalance">
                                        <option value="" class="d-none">{{ __('Select Leave Type') }}</option>
                                        <option :value="leaveType.id" v-for="leaveType in leaveTypes" :key="leaveType.id">
                                            {{ leaveType.name }}
                                        </option>
                                    </select>
                                    <ErrorMessage :name="form.errors.leave_type_id" />
                                    <template v-if="showLeaveTypeBalance">
                                        <strong :class="!leaveTypeBalance.remaining_days ? 'text-danger':'text-secondary'" v-if="leaveTypeBalance">{{ __('Leave Type Balance') }}: {{ leaveTypeBalance.remaining_days }}/{{ leaveTypeBalance.total_days }}</strong>
                                    </template>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <Label :name="__('Start Date')" />
                                    <Datepicker v-model="form.start" :enableTimePicker="false"
                                        @update:modelValue="handleStartDate" :class="{'is-invalid':form.errors.start}" :placeholder="__('Start Date')"/>
                                    <ErrorMessage :name="form.errors.start"/>

                                </div>
                                <div class="col-md-6">
                                    <Label :name="__('End Date')" />
                                    <Datepicker v-model="form.end" :enableTimePicker="false"
                                        @update:modelValue="handleEndDate" :class="{'is-invalid':form.errors.end}" :disabled="!form.start" :placeholder="__('End Date')"/>
                                    <ErrorMessage :name="form.errors.end"/>
                                </div>
                                <template v-if="diffBetweenDays">
                                    <strong class="ml-1" :class="leaveTypeBalance.remaining_days < diffBetweenDays ? 'text-danger':'text-secondary'" v-if="leaveTypeBalance">{{ __('Number of Days') }}: {{ diffBetweenDays }}</strong>
                                </template>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-lg-12">
                                    <Label :name="__('Reason')" />
                                    <textarea class="form-control" v-model="form.reason" :class="{'is-invalid':form.errors.reason}" rows="5" :placeholder="__('Reason')"></textarea>
                                    <ErrorMessage :name="form.errors.reason" />
                                </div>
                            </div>
                            <button :disabled="submitButtonDisabled" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing" message="Sending..."/>
                                <span v-else>
                                    <i class="fa-regular fa-paper-plane"></i>
                                    {{ __('Send Request') }}
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="card">
                            <div class="card-bod">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Leave Type') }}</th>
                                            <th>{{ __('Balance') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="leaveTypeBalances && leaveTypeBalances.length">
                                            <tr v-for="leaveTypeBalance in leaveTypeBalances" :key="leaveTypeBalance.id">
                                                <td>{{ leaveTypeBalance.leave_type.name }}</td>
                                                <td>{{ leaveTypeBalance.remaining_days }}/{{ leaveTypeBalance.total_days }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import dayjs from "dayjs";

export default {
    props: {
        leaveTypes: {
            type: Array,
            required: true,
        },
        leaveTypeBalances: {
            type: Array,
            required: true,
        },
    },
    components: {
        Datepicker,
    },
    data() {
        return {
            form: this.$inertia.form({
                leave_type_id: "",
                start: "",
                end: "",
                reason: "",
            }),

            leaveTypeBalance: {},
            showLeaveTypeBalance: false,
            diffBetweenDays: 0,
            employee: this.$page.props.authenticatedUser.employee,
        };
    },
    methods: {
        sendData() {
            this.form.post(route("employee.leave.request.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        statusChange(event) {
            this.form.status = event.target.checked;
        },
        async fetchCompanyWiseData() {
            this.leaveTypes = [];
            this.employeesUsers = [];
            let leaveTypesData = await axios.get(
                route("companies.leaveTypes", this.form.user_id)
            );
            let employeesUsersData = await axios.get(
                route("companies.employees", this.form.user_id)
            );

            this.leaveTypes = leaveTypesData.data.leaveTypes;
            this.employeesUsers = employeesUsersData.data.employeesUsers;
        },
        handleStartDate(startDate) {
            const formatTime = dayjs(startDate).format("YYYY-MM-DD");

            if(this.form.end){
                let dateCheck = this.checkDateValidity(formatTime, this.form.end);

                if(!dateCheck){
                    this.form.end = ''
                    return this.toastError("End date must be grater than start date")
                }
            }

            this.form.start = formatTime;
        },
        handleEndDate(endDate) {
            const formatTime = dayjs(endDate).format("YYYY-MM-DD");

            if(this.form.start){
                let dateCheck = this.checkDateValidity(this.form.start, formatTime);

                if(!dateCheck){
                    this.form.end = ''
                    return this.toastError("End date must be grater than start date")
                }
            }

            this.form.end = formatTime;
        },
        async checkLeaveTypeBalance() {
            let response = await axios.get(
                route("employee.leave.type.balance", this.form.leave_type_id)
            );

            this.leaveTypeBalance = response.data;
            this.showLeaveTypeBalance = true;
        }
    },
    computed: {
        dates() {
            return `${this.form.start}|${this.form.end}`;
        },
        submitButtonDisabled() {
            return (
                this.form.processing ||
                !this.leaveTypeBalance.remaining_days ||
                this.leaveTypeBalance.remaining_days < this.diffBetweenDays
            );
        }
    },
    watch: {
        async dates(newVal) {
            const [start, end] = newVal.split("|");

            if (start && end) {
                let response = await axios.get(
                    route("difference.between.days"),
                    {
                        params: {
                            start: this.form.start,
                            end: this.form.end,
                            company_id: this.employee.company_id,
                        },
                    }
                );

                this.diffBetweenDays = response.data.final_days_count;
            }
        }
    },
    mounted() {
        this.checkPagePermission("employee");
    },
};
</script>

<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 35px;
        height: 19px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 3px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.success:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(15px);
        -ms-transform: translateX(15px);
        transform: translateX(15px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
