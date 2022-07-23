<template>

    <Head :title="__('Plan')" />
    <div class="row align-items-end justify-content-center">
        <!-- Set Recommended Plan -->
        <SetRecommended :plans="plans"/>

        <div class="col-md-4 d-flex mb-3 justify-content-end">
            <Link :href="route('plans.create')" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                {{ __('Create Plan') }}
            </Link>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12" v-for="plan in plans" :key="plan.id">
            <div class="card h-100 shadow-sm">
                <div class="card-header text-center py-4">
                    <h4>
                        <b>{{ plan.name }}</b>
                        <small v-if="plan.interval != 'custom_days'"> /{{ plan.interval }}</small>
                        <small v-else> /{{ plan.custom_interval_days }} {{ __('Days') }}</small>
                        <!-- custom_interval_days -->
                    </h4>
                    <div class="badge badge-info" v-if="plan.recommended">{{ __('Recommended') }}</div>
                    <h1 class="text-dark">
                        ${{ plan.price }}
                    </h1>
                </div>
                <div class="card-body" v-if="plan.plan_features">
                   <Feature name="Unlimited Employees" :checked="!plan.plan_features.is_limited_employee"/>
                   <Feature name="Max Employees" :checked="true" :value="plan.plan_features.is_limited_employee ? plan.plan_features.max_employees : '∞'"/>
                   <Feature name="Max Teams" :checked="true" :value="plan.plan_features.max_teams"/>
                   <Feature name="Max Leave Types" :checked="true" :value="plan.plan_features.max_leave_types"/>
                   <Feature name="Custom Theme Look" :checked="plan.plan_features.custom_theme_look"/>
                </div>
                <div class="card-footer">
                    <div class=" d-flex justify-content-between">
                        <a href="" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            {{ __('Edit') }}
                        </a>
                        <button type="submit" class="btn btn-danger w-100-p" v-if="plan.type != 'free'">
                            <i class="fas fa-trash"></i>
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Feature from "../../../Shared/Admin/Plan/Feature.vue";
import SetRecommended from "../../../Shared/Admin/Plan/SetRecommended.vue";

export default {
    components: {
        Feature,
        SetRecommended,
    },
    props: {
        plans: {
            type: Array,
            required: true,
        },
    },
    // components: {
    //     Datepicker,
    // },
    // data() {
    //     return {
    //         form: this.$inertia.form({
    //             user_id: "",
    //             leave_type_id: "",
    //             employee_id: "",
    //             start: "",
    //             end: "",
    //             reason: "",
    //             status: "pending",
    //         }),
    //         leaveTypes: [],
    //         employeesUsers: [],
    //         leaveTypeBalance: {},
    //         showLeaveTypeBalance: false,
    //         diffBetweenDays: 0,
    //     };
    // },
    // methods: {
    //     createData() {
    //         this.form.post(route("leaveRequests.store"));
    //     },
    //     statusChange(event) {
    //         this.form.status = event.target.checked;
    //     },
    //     async fetchCompanyWiseData() {
    //         this.leaveTypes = [];
    //         this.employeesUsers = [];
    //         let leaveTypesData = await axios.get(
    //             route("companies.leaveTypes", this.form.user_id)
    //         );
    //         let employeesUsersData = await axios.get(
    //             route("companies.employees", this.form.user_id)
    //         );
    //         this.leaveTypes = leaveTypesData.data.leaveTypes;
    //         this.employeesUsers = employeesUsersData.data.employeesUsers;
    //     },
    //     handleStartDate(startDate) {
    //         const formatTime = dayjs(startDate).format("YYYY-MM-DD");
    //         this.form.start = formatTime;
    //     },
    //     handleEndDate(endDate) {
    //         const formatTime = dayjs(endDate).format("YYYY-MM-DD");
    //         this.form.end = formatTime;
    //     },
    //     async checkLeaveTypeBalance() {
    //         console.log(this.form.employee_id);
    //         console.log(this.form.leave_type_id);
    //         let response = await axios.get(
    //             route("companies.employee.leave.type.balance"),
    //             {
    //                 params: {
    //                     employee_id: this.form.employee_id,
    //                     leave_type_id: this.form.leave_type_id,
    //                 },
    //             }
    //         );
    //         this.leaveTypeBalance = response.data;
    //         this.showLeaveTypeBalance = true;
    //     },
    // },
};
</script>

<style scoped>

</style>
