<template>
    <Head :title="__('Edit Leave Request')" />
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Edit Leave Request') }}</h3>
                        <Link :href="route('company.leaveRequests.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                            {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="updateData">
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <Label :name="__('Leave Type')" />
                                    <select @change="checkLeaveTypeBalance"  v-model="form.leave_type_id" id="company" class="form-control"
                                        :class="{'is-invalid':form.errors.leave_type_id}">
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
                                <div class="col-md-6">
                                    <Label :name="__('Employee')" />
                                    <select v-model="form.employee_id" id="company" class="form-control"
                                        :class="{'is-invalid':form.errors.employee_id}">
                                        <option value="" class="d-none">{{ __('Select Employee') }}</option>
                                        <option :value="employeesUser.id" v-for="employeesUser in employeesUsers" :key="employeesUser.id">
                                            {{ employeesUser.user.name }}
                                        </option>
                                    </select>
                                    <ErrorMessage :name="form.errors.employee_id" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <Label name="Start Date" />
                                    <Datepicker v-model="form.start" :enableTimePicker="false"
                                        @update:modelValue="handleStartDate" :class="{'is-invalid':form.errors.start}"/>
                                    <ErrorMessage :name="form.errors.start"/>
                                </div>
                                <div class="col-md-6">
                                    <Label name="End Date" />
                                    <Datepicker v-model="form.end" :enableTimePicker="false"
                                        @update:modelValue="handleEndDate" :class="{'is-invalid':form.errors.end}"/>
                                    <ErrorMessage :name="form.errors.end"/>
                                </div>
                                <template v-if="diffBetweenDays">
                                    <strong class="ml-1" :class="leaveTypeBalance.remaining_days < diffBetweenDays ? 'text-danger':'text-secondary'" v-if="leaveTypeBalance">{{ __('Number of Days') }}: {{ diffBetweenDays }}</strong>
                                </template>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-lg-12">
                                    <Label name="Reason" :required="false" />
                                    <textarea class="form-control" v-model="form.reason" :class="{'is-invalid':form.errors.reason}" rows="5"></textarea>
                                    <ErrorMessage :name="form.errors.reason" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <Label name="Status" :required="false"/> <br>
                                    <div class="form-check form-check-inline">
                                        <input v-model="form.status" class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="pending" value="pending">
                                        <label class="form-check-label" for="pending">{{ __('Pending') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="form.status" class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="approved" value="approved">
                                        <label class="form-check-label" for="approved">{{ __('Approve') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input v-model="form.status" class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="rejected" value="rejected">
                                        <label class="form-check-label" for="rejected">{{ __('Reject') }}</label>
                                    </div>
                                    <ErrorMessage :name="form.errors.end" className="d-block text-danger"/>
                                </div>
                            </div>
                            <button :disabled="submitButtonDisabled" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing"/>
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    {{ __('Save') }}
                                </span>
                            </button>
                            </form>
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
        users: {
            type: Array,
            required: true,
        },
        leaveRequest: {
            type: Object,
            required: true,
        },
        leaveTypes: {
            type: Array,
            required: true,
        },
        employeesUsers: {
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
                leave_type_id: this.leaveRequest.leave_type_id,
                employee_id: this.leaveRequest.employee_id,
                start: dayjs(this.leaveRequest.start).format("YYYY-MM-DD"),
                end: dayjs(this.leaveRequest.end).format("YYYY-MM-DD"),
                reason: this.leaveRequest.reason,
                status: this.leaveRequest.status,
            }),

            leaveTypes: this.leaveTypes,
            employeesUsers: this.employeesUsers,

            leaveTypeBalance: {},
            showLeaveTypeBalance: false,
            diffBetweenDays: 0,
            auth_user: this.$page.props.authenticatedUser,
        };
    },
    methods: {
        updateData() {
            this.form.put(
                route("company.leaveRequests.update", this.leaveRequest.id)
            );
        },
        statusChange(event) {
            this.form.status = event.target.checked;
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
                route("company.employee.leave.type.balance"),
                {
                    params: {
                        employee_id: this.form.employee_id,
                        leave_type_id: this.form.leave_type_id,
                    },
                }
            );

            this.leaveTypeBalance = response.data;
            this.showLeaveTypeBalance = true;
        },
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
        },
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
                            company_id: this.auth_user.company.id,
                        },
                    }
                );

                this.diffBetweenDays = response.data.final_days_count;
            }
        },
    },
     mounted(){
        this.checkPagePermission('owner')
    }
};
</script>

<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 35px;
        height: 19px;
        /* width: 60px;
                                                                                                                                                height: 34px; */
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
