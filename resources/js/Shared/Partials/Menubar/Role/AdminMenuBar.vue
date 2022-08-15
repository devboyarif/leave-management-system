<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <Link :href="route('dashboard')" class="brand-link">
        <img :src="setting.app_favicon" alt="logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ setting.app_name }}</span>
        </Link>

        <!-- Sidebar -->
        <div class="sidebar" style="overflow-y: auto;">
            <nav class="sidebar-main-nav mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Leave Manage  -->
                    <li class="nav-header">{{ __('Leave Manage') }}</li>
                    <NavLink title="Leave Type" :href="route('leaveTypes.index')"
                        :active="$page.component == 'admin/leaveType/index' || $page.component == 'admin/leaveType/create' || $page.component == 'admin/leaveType/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-list nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Leave Request" :href="route('leaveRequests.index')"
                        :active="$page.component == 'admin/leaveRequest/index' || $page.component == 'admin/leaveRequest/create' || $page.component == 'admin/leaveRequest/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-file-pen nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Holidays" :href="route('holidays.index')"
                        :active="$page.component == 'admin/holiday/index' || $page.component == 'admin/holiday/show' || $page.component == 'admin/holiday/holidayRequest'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Reports" :href="route('reports.index')"
                        :active="$page.component == 'admin/reports/index' || $page.component == 'admin/reports/employeeLeaveBalance' || $page.component == 'admin/reports/employeeLeaveHistory' || $page.component == 'admin/reports/teamLeaveBalance' || $page.component == 'admin/reports/teamLeaveHistory'">
                        <template v-slot:icon>
                            <i class="fa-regular fa-calendar-days nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Subscription Part  -->
                    <li class="nav-header">{{ __('Subscription Manage') }}</li>
                    <NavLink title="Plan" :href="route('plans.index')"
                        :active="$page.component == 'admin/plan/index' || $page.component == 'admin/plan/create' || $page.component == 'admin/plan/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-credit-card nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Orders" :href="route('orders.index')"
                        :active="$page.component == 'admin/order/index'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Users Manage  -->
                    <li class="nav-header">{{ __('User Manage') }}</li>
                    <NavLink title="Admin" :href="route('admins.index')"
                        :active="$page.component == 'admin/user/index' || $page.component == 'admin/user/create' || $page.component == 'admin/user/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-secret nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Company" :href="route('companies.index')"
                        :active="$page.component == 'admin/company/index' || $page.component == 'admin/company/create' || $page.component == 'admin/company/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-building-user nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Employee" :href="route('employees.index')"
                        :active="$page.component == 'admin/employee/index' || $page.component == 'admin/employee/create' || $page.component == 'admin/employee/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-tie nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Team" :href="route('teams.index')" :active="$page.component == 'admin/team/index'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>

                    <!-- Settings Part  -->
                    <li class="nav-header">{{ __('Others') }}</li>
                    <NavLink title="Blog" :href="route('posts.index')"
                        :active="$page.component == 'admin/others/blog/index' || $page.component == 'admin/others/blog/create' || $page.component == 'admin/others/blog/edit'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-blog nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Testimonial" :href="route('testimonials.index')"
                        :active="$page.component == 'admin/others/testimonial'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-star nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Faq" :href="route('faqs.index')" :active="$page.component == ' admin/others/faq'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-question nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Features" :href="route('features.index')" :active="$page.component == ' admin/others/features'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-key nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Contact Messages" :href="route('contact.messages')"
                        :active="$page.component == ' admin/others/faq'">
                        <template v-slot:icon>
                            <i class="fa-regular fa-address-book nav-icon"></i>
                        </template>
                    </NavLink>
                </ul>
            </nav>

            <nav class="mt-2 nav-footer pt-3 border-top border-secondary">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu" data-accordion="false">
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
            setting: this.$page.props.setting,
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
    mounted() {
        console.log(this.$page.props.setting);
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
