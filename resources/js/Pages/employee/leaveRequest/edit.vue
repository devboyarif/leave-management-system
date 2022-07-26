<template>

    <Head :title="__('Edit Leave Request')" />
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>{{ __('Edit Leave Request') }}</h3>
                        <Link :href="route('employee.leave.request.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Leave Request List') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="saveData">
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                 <Label name="Leave Type" />
                                <select v-model="form.leave_type_id" id="company" class="form-control"
                                    :class="{'is-invalid':form.errors.leave_type_id}">
                                    <option value="" class="d-none">{{ __('Select Leave Type') }}</option>
                                    <option :value="leaveType.id" v-for="leaveType in leaveTypes" :key="leaveType.id">
                                        {{ leaveType.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.leave_type_id" />
                            </div>
                        </div>
                         <div class="mb-3 row">
                            <div class="col-md-6">
                                <Label :name="__('Start Date')" />
                                <Datepicker v-model="form.start" :enableTimePicker="false"
                                    @update:modelValue="handleStartDate" :class="{'is-invalid':form.errors.start}"/>
                                <ErrorMessage :name="form.errors.start"/>
                            </div>
                            <div class="col-md-6">
                                <Label :name="__('End Date')" />
                                <Datepicker v-model="form.end" :enableTimePicker="false"
                                    @update:modelValue="handleEndDate" :class="{'is-invalid':form.errors.end}"/>
                                <ErrorMessage :name="form.errors.end"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-12">
                                <Label :name="__('Reason')" />
                                <textarea class="form-control" v-model="form.reason" :class="{'is-invalid':form.errors.reason}" rows="5"></textarea>
                                <ErrorMessage :name="form.errors.reason" />
                            </div>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing" message="Sending..."/>
                            <span v-else>
                                <i class="fa-regular fa-paper-plane"></i>
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
        leaveTypes: {
            type: Array,
            required: true,
        },
        leaveRequest: {
            type: Object,
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
                start: this.leaveRequest.start,
                end: this.leaveRequest.end,
                reason: this.leaveRequest.reason,
            }),
        };
    },
    methods: {
        saveData() {
            this.form.put(
                route("employee.leave.request.update", this.leaveRequest.id),
                {
                    onSuccess: () => this.form.reset(),
                }
            );
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
            this.form.start = formatTime;
        },
        handleEndDate(endDate) {
            const formatTime = dayjs(endDate).format("YYYY-MM-DD");
            this.form.end = formatTime;
        },
    },
    mounted(){
        this.checkPagePermission('employee')
    }
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
