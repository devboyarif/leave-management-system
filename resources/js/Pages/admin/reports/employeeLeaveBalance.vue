<template>

    <Head :title="__('Employee Leave Balance')" />

    <div class="row justify-content-center pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Employee Leave Balance') }}</h3>
                        <Link :href="route('company.reports.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row justify-content-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="mr-sm-2">{{ __('Company') }}</label>
                            <select class="custom-select mr-sm-2" v-model="company">
                                <option value="" class="d-none">{{ __('Select Company') }}</option>
                                <option v-for="company in companies" :key="company.id" :value="company.id">
                                    {{ company.user.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <button :disabled="buttonDisabled" @click="getReport" type="button" class="btn btn-primary" style="margin-top:30px">
                                <Loading v-if="buttonLoading" />
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    {{ __('Get Report') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <template v-if="leave_types.length && employees.length">
                    <table style="width:100%" class="table table-bordered">
                        <tr class="h5">
                            <th width="20%" rowspan="2">Employee</th>
                            <th colspan="2" v-for="leave_type in leave_types" :key="leave_type.id">
                                {{ leave_type.name }}
                            </th>
                            <th colspan="2">
                                Total Leave
                            </th>
                        </tr>
                        <tr class="h5">
                            <template v-for="i in leave_types.length" :key="i">
                                <th>Used</th>
                                <th>Total</th>
                            </template>
                            <th>Used</th>
                            <th>Total</th>
                        </tr>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td v-if="employee.user">
                                <img :src="employee.user.avatar" alt="Product 1" class="img-circle img-size-32 mr-1">
                                <span v-html="employee.user.name"></span>
                            </td>
                            <template v-if="employee.leave_balances">
                                <template v-for="leave_balance in employee.leave_balances" :key="leave_balance.id">
                                    <td>{{ leave_balance.used_days }}</td>
                                    <td>{{ leave_balance.total_days }}</td>
                                </template>
                                <td>{{ usedLeaveDays(employee.leave_balances) }}</td>
                                <td>{{ totalLeaveDays(employee.leave_balances) }}</td>
                            </template>
                        </tr>
                    </table>
                </template>
            </div>
        </div>
    </div>

</template>


<script>
export default {
    props: {
        leave_types: Array,
        employees: Array,
        companies: Array,
        filter_company: Number,
    },
    data() {
        return {
            company: this.filter_company || "",
            buttonLoading: false,
        };
    },
    methods: {
        usedLeaveDays(leave_balances) {
            let total = 0;
            for (let i = 0; i < leave_balances.length; i++) {
                total += leave_balances[i].used_days;
            }
            return total;
        },
        totalLeaveDays(leave_balances) {
            let total = 0;
            for (let i = 0; i < leave_balances.length; i++) {
                total += leave_balances[i].total_days;
            }
            return total;
        },
        getReport() {
            this.buttonLoading = true;
            this.$inertia.get(
                route("reports.employee.leave.balance"),
                {
                    company: this.company,
                },
                {
                    onSuccess: () => {
                        this.buttonLoading = false;
                    },
                }
            );
        },
    },
    computed: {
        buttonDisabled() {
            return this.company == "";
        },
    },
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>
