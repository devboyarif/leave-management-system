<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <Link :href="route('dashboard')" class="brand-link">
        <img :src="$page.props.authenticatedUser.avatar" alt="logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ $page.props.authenticatedUser.name }}</span>
        </Link>

        <!-- Sidebar -->
        <div class="sidebar" style="overflow-y: auto;">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Leave Manage  -->
                    <li class="nav-header">{{ __('Leave Manage') }}</li>
                    <NavLink title="Leave Type" :href="route('company.leaveTypes.index')"
                        :active="$page.component == 'company/leaveType/index' || $page.component == 'company/leaveType/create' || $page.component == 'company/leaveType/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-list nav-icon"></i>
                        </template>
                        <template v-slot:badge v-if="!hasAccessLeaveType">
                            <span class="right badge badge-danger">{{ __('Pro') }}</span>
                        </template>
                    </NavLink>
                    <NavLink title="Leave Request" :href="route('company.leaveRequests.index')"
                        :active="$page.component == 'company/leaveRequest/index' || $page.component == 'company/leaveRequest/create' || $page.component == 'company/leaveRequest/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-file-pen nav-icon"></i>
                        </template>
                    </NavLink>

                    <NavLink title="Holidays" :href="route('company.holidays.index')"
                        :active="$page.url == '/company/holidays' || $page.url == '/company/holidays/*' || $page.component == 'company/holiday/holidayRequest'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Subscription Part  -->
                    <li class="nav-header">{{ __('Subscription') }}</li>
                    <NavLink title="Pricing Plan" :href="route('company.plan')"
                        :active="$page.component == 'company/plan'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-money-bill nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Orders" :href="route('company.orders.index')"
                        :active="$page.component == 'company/order/index'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Users Manage  -->
                    <li class="nav-header">{{ __('User Manage') }}</li>
                    <NavLink title="Employee" :href="route('company.employees.index')"
                        :active="$page.component == 'company/employees'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Teams" :href="route('company.teams.index')"
                        :active="$page.url == '/admin/holidays' || $page.component == 'company/teams'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Reports" :href="route('company.reports.index')"
                        :active="$page.component == 'company/reports/index' || $page.component == 'company/reports/employeeLeaveBalance' || $page.component == 'company/reports/employeeLeaveHistory' || $page.component == 'company/reports/teamLeaveBalance' || $page.component == 'company/reports/teamLeaveHistory'">
                        <template v-slot:icon>
                            <i class="fa-regular fa-calendar-days nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Settings Part  -->
                    <li class="nav-header">{{ __('Settings') }}</li>
                    <NavLink title="Settings" :href="route('company.settings.general')" :active="$page.component == 'company/settings'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gear nav-icon"></i>
                        </template>
                    </NavLink>
                    <li class="nav-item">
                        <Link href="/logout" class="nav-link" method="post">
                        <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                        <p>{{ __('Logout') }}</p>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import Dropdown from "../Dropdown.vue";
import NavLink from "../NavItem.vue";

export default {
    components: {
        Dropdown,
        NavLink,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
            subscription: this.$page.props.current_subscription,
        };
    },
    computed: {
        hasAccessLeaveType() {
            return (
                this.subscription.plan &&
                this.subscription.plan.plan_features &&
                this.subscription.plan.plan_features.max_leave_types
            );
        },
    },
    methods: {
        dropdownActive(pageComponent) {
            return (
                pageComponent == "company/leaveType/index" ||
                pageComponent == "company/leaveType/create" ||
                pageComponent == "company/leaveType/edit" ||
                pageComponent == "company/leaveRequest/index" ||
                pageComponent == "company/leaveRequest/create" ||
                pageComponent == "company/leaveRequest/edit"
            );
        },
    },
};
</script>

<style scoped>
    .nav-sidebar>.nav-header {
        margin-left: 0.6rem;
        margin-top: 10px;
        color: #ffffff;
        opacity: 1;
        padding-bottom: 2px;
    }
</style>
