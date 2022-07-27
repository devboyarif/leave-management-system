<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="overflow-y: auto;">

            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>

                     <!-- Users Manage  -->
                    <li class="nav-header">{{ __('User Manage') }}</li>
                    <NavLink title="Admin" :href="route('admins.index')" :active="$page.component == 'admin/user/index' || $page.component == 'admin/user/create' || $page.component == 'admin/user/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-secret nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Company" :href="route('companies.index')" :active="$page.component == 'admin/company/index' || $page.component == 'admin/company/create' || $page.component == 'admin/company/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-building-user nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Employee" :href="route('employees.index')"  :active="$page.component == 'admin/employee/index' || $page.component == 'admin/employee/create' || $page.component == 'admin/employee/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-tie nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Team" :href="route('teams.index')" :active="$page.component == 'admin/team/index'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Leave Manage  -->
                    <li class="nav-header">{{ __('Leave Manage') }}</li>
                     <NavLink title="Leave Type" :href="route('leaveTypes.index')" :active="$page.component == 'admin/leaveType/index' || $page.component == 'admin/leaveType/create' || $page.component == 'admin/leaveType/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-list nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Leave Request" :href="route('leaveRequests.index')" :active="$page.component == 'admin/leaveRequest/index' || $page.component == 'admin/leaveRequest/create' || $page.component == 'admin/leaveRequest/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-file-pen nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Holidays" :href="route('holidays.index')" :active="$page.component == 'admin/holiday/index' || $page.component == 'admin/holiday/show' || $page.component == 'admin/holiday/holidayRequest'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Subscription Part  -->
                    <li class="nav-header">{{ __('Subscription Manage') }}</li>
                     <NavLink title="Plan" :href="route('plans.index')" :active="$page.component == 'admin/plan/index' || $page.component == 'admin/plan/create' || $page.component == 'admin/plan/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-credit-card nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Orders" :href="route('orders.index')" :active="$page.component == 'admin/order/index'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Settings Part  -->
                    <li class="nav-header">{{ __('Settings') }}</li>
                    <NavLink title="Settings" :href="route('settings.general')">
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
        };
    },
    methods: {
        leaveDropdownActive(pageComponent) {
            return (
                pageComponent == "admin/leaveType/index" ||
                pageComponent == "admin/leaveType/create" ||
                pageComponent == "admin/leaveType/edit" ||
                pageComponent == "admin/leaveRequest/index" ||
                pageComponent == "admin/leaveRequest/create" ||
                pageComponent == "admin/leaveRequest/edit"
            );
        },
        userDropdownActive(pageComponent) {
            return (
                pageComponent == "admin/user/index" ||
                pageComponent == "admin/user/create" ||
                pageComponent == "admin/user/edit" ||
                pageComponent == "admin/company/index" ||
                pageComponent == "admin/company/create" ||
                pageComponent == "admin/company/edit" ||
                pageComponent == "admin/employee/index" ||
                pageComponent == "admin/employee/create" ||
                pageComponent == "admin/employee/edit"
            );
        },

        // $page.url == '/admin/admins/*' || $page.url == '/admin/companies/*' || $page.url == '/admin/employees/*'
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
