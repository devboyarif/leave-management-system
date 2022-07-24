<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img :src="$page.props.authenticatedUser.avatar" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ $page.props.authenticatedUser.name }}</span>
        </a>

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
                     <Dropdown title="Leave" :active="dropdownActive($page.component)">
                        <template v-slot:icon>
                            <i class="fa-solid fa-plane-departure nav-icon"></i>
                        </template>
                        <NavLink title="Leave Type" :href="route('company.leaveTypes.index')" :active="$page.component == 'company/leaveType/index' || $page.component == 'company/leaveType/create' || $page.component == 'company/leaveType/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                             <template v-slot:badge v-if="!hasAccessLeaveType">
                            <span class="right badge badge-danger">{{ __('Pro') }}</span>
                        </template>
                        </NavLink>
                        <NavLink title="Leave Request" :href="route('company.leaveRequests.index')" :active="$page.component == 'company/leaveRequest/index' || $page.component == 'company/leaveRequest/create' || $page.component == 'company/leaveRequest/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                    <NavLink title="Employee" :href="route('company.employees.index')" :active="$page.component == 'company/employees'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Teams" :href="route('company.teams.index')" :active="$page.url == '/admin/holidays' || $page.component == 'company/teams'">
                        <template v-slot:icon>
                          <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Reports" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Holidays" :href="route('company.holidays.index')" :active="$page.url == '/company/holidays' || $page.url == '/company/holidays/*'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Theme" :href="route('company.theme.index')" :active="$page.url == '/company/theme'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-language nav-icon"></i>
                        </template>
                        <template v-slot:badge v-if="!hasAccessCustomThemeLook">
                            <span class="right badge badge-danger">{{ __('Pro') }}</span>
                        </template>
                    </NavLink>
                    <NavLink title="Pricing Plan" :href="route('company.plan')" :active="$page.component == 'company/plan'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-money-bill nav-icon"></i>
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
        hasAccessCustomThemeLook() {
            return (
                this.subscription.plan &&
                this.subscription.plan.plan_features &&
                this.subscription.plan.plan_features.custom_theme_look
            );
        },
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
