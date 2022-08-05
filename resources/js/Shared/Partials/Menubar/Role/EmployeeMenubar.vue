<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img :src="employeeCompanyUser.avatar" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ employeeCompanyUser.name }}</span>
        </a>
        <div class="sidebar" style="overflow-y: auto;">

            <nav class="sidebar-main-nav mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu" data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>

                    <NavLink title="Colleagues" :href="route('employee.teams')"
                        :active="$page.component == 'employee/teams'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Leave Request" :href="route('employee.leave.request.index')"
                        :active="$page.component == 'employee/leaveRequest/index' || $page.component == 'employee/leaveRequest/create' || $page.component == 'employee/leaveRequest/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Holidays" :href="route('employee.holidays')"
                        :active="$page.url == '/employee/holidays'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>
                    <li class="nav-item">
                        <Link href="/logout" class="nav-link" method="post">
                            <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                            <p>{{ __('Logout') }}</p>
                        </Link>
                    </li>
                    <NavLink title="Apply for Leave" :href="route('employee.leave.request.create')"
                        class="mt-4 bg-danger">
                        <template v-slot:icon>
                            <i class="fa-solid fa-person-walking-luggage nav-icon"></i>
                        </template>
                    </NavLink>
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
            user: this.$page.props.authenticatedUser,
            employeeCompanyUser: this.$page.props.employeeCompanyUser,
        };
    },
};
</script>
