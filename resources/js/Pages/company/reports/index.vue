<template>

    <Head :title="__('Report List')" />

    <div class="row justify-content-center pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Reports') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="row">
                            <div class="col-md-6 p-2">
                                <Link :href="route('company.reports.employee.leave.balance')" class="list-group-item list-group-item-action flex-column align-items-start">
                                   <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ __('Employees Leave Balance') }}</h5>
                                    </div>
                                    <p class="mb-1">
                                        {{ __('Click to view the employees leave balance') }}
                                    </p>
                                </Link>
                            </div>
                            <div class="col-md-6 p-2">
                                <Link :href="route('company.reports.employee.leave.history')" class="list-group-item list-group-item-action flex-column align-items-start ">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ __('Employee Leave History') }}</h5>
                                    </div>
                                    <p class="mb-1">
                                        {{ __('Click on the reports to view the leave history of an employee') }}
                                    </p>
                                </Link>
                            </div>
                            <div class="col-md-6 p-2">
                                <Link :href="route('company.reports.team.leave.balance')" class="list-group-item list-group-item-action flex-column align-items-start ">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ __('Team Leave Balance') }}</h5>
                                    </div>
                                    <p class="mb-1">
                                        {{ __('Click to view the leave balance of all employees in a team') }}
                                    </p>
                                </Link>
                            </div>
                            <div class="col-md-6 p-2">
                                <Link :href="route('company.reports.team.leave.history')" class="list-group-item list-group-item-action flex-column align-items-start ">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ __('Team Leave History') }}</h5>
                                    </div>
                                    <p class="mb-1">
                                        {{ __('Click to view the leave history of all employees in a team') }}.
                                    </p>
                                </Link>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
export default {
    data() {
        return {};
    },
    methods: {},
    mounted() {
        this.checkPagePermission("owner");
    },
};
</script>
