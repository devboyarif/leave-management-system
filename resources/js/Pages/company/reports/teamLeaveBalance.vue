<template>

    <Head :title="__('Employee Leave Balance')" />

    <div class="row justify-content-center pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Team Leave Balance') }}</h3>
                        <Link :href="route('company.reports.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
            </div>
            <div class="card" v-for="(team_employee, key) in team_employees" :key="key">
                <div class="card-body">
                    <h5>{{ team_employee[0].team.name }}</h5>
                    <hr>
                    <table style="width:100%" class="table table-bordered">
                        <tr class="h5">
                            <th width="20%" rowspan="2">{{ __('Employee') }}</th>
                            <th colspan="2" v-for="leave_type in leave_types" :key="leave_type.id">
                                {{ leave_type.name }}
                            </th>
                            <th colspan="2">
                                {{ __('Total Leave') }}
                            </th>
                        </tr>
                        <tr class="h5">
                            <template v-for="i in leave_types.length" :key="i">
                                <th>{{ __('Used') }}</th>
                                <th>{{ __('Total') }}</th>
                            </template>
                            <th>{{ __('Used') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                        <tr v-for="employee in team_employee" :key="employee.id">
                            <td v-if="employee.user">
                                <Link :href="route('company.employees.show',employee.user_id)">
                                    <img :src="employee.user.avatar" alt="img"
                                        class="img-circle img-size-32 mr-1">
                                    <span v-html="employee.user.name"></span>
                                </Link>
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
                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {
        props: {
            leave_types: Array,
            team_employees: Array,
        },
        data() {
            return {

            };
        },
        methods: {
            usedLeaveDays(leave_balances){
                let total = 0;
                for (let i = 0; i < leave_balances.length; i++) {
                    total += leave_balances[i].used_days;
                }
                return total;
            },
            totalLeaveDays(leave_balances){
                let total = 0;
                for (let i = 0; i < leave_balances.length; i++) {
                    total += leave_balances[i].total_days;
                }
                return total;
            }
        },
         mounted(){
            this.checkPagePermission('owner')
        }
    };
</script>
