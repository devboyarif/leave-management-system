<template>

    <Head title="Leave Request Create" />
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Leave Request Create</h3>
                        <Link :href="route('company.leaveTypes.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="createData">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                 <Label name="Leave Type" />
                                <select v-model="form.leave_type_id" id="company" class="form-control"
                                    :class="{'is-invalid':form.errors.leave_type_id}">
                                    <option value="" class="d-none">Select Leave Type</option>
                                    <option :value="leaveType.id" v-for="leaveType in leaveTypes" :key="leaveType.id">
                                        {{ leaveType.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.leave_type_id" />
                            </div>
                            <div class="col-md-6">
                                 <Label name="Employee" />
                                <select v-model="form.employee_id" id="company" class="form-control"
                                    :class="{'is-invalid':form.errors.employee_id}">
                                    <option value="" class="d-none">Select Employee</option>
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
                                    <label class="form-check-label" for="pending">Pending</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input v-model="form.status" class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="approved" value="approved">
                                    <label class="form-check-label" for="approved">Approved</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input v-model="form.status" class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="rejected" value="rejected">
                                    <label class="form-check-label" for="rejected">Rejected</label>
                                </div>
                                <ErrorMessage :name="form.errors.end" className="d-block text-danger"/>
                            </div>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                Save
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
                leave_type_id: "",
                employee_id: "",
                start: "",
                end: "",
                reason: "",
                status: "pending",
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("company.leaveRequests.store"));
        },
        statusChange(event) {
            this.form.status = event.target.checked;
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
