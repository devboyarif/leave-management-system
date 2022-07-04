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
                    <Dropdown title="Users" :active="userDropdownActive($page.component)">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-group nav-icon"></i>
                        </template>
                        <NavLink title="Admin" :href="route('admins.index')" :active="$page.component == 'admin/user/index' || $page.component == 'admin/user/create' || $page.component == 'admin/user/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Company" :href="route('companies.index')" :active="$page.component == '/admin/company/index' || $page.component == '/admin/company/create' || $page.component == '/admin/company/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Employee" :href="route('employees.index')"  :active="$page.component == '/admin/employee/index' || $page.component == '/admin/employee/create' || $page.component == '/admin/employee/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                    <NavLink title="Team" :href="route('teams.index')" :active="$page.url == '/admin/teams'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                     <Dropdown title="Leave" :active="leaveDropdownActive($page.component)">
                        <template v-slot:icon>
                            <i class="fa-solid fa-plane-departure nav-icon"></i>
                        </template>
                        <NavLink title="Leave Type" :href="route('leaveTypes.index')" :active="$page.component == 'admin/leaveType/index' || $page.component == 'admin/leaveType/create' || $page.component == 'admin/leaveType/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Leave Request" :href="route('leaveRequests.index')" :active="$page.component == 'admin/leaveRequest/index' || $page.component == 'admin/leaveRequest/create' || $page.component == 'admin/leaveRequest/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                     <NavLink title="Holidays" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Language" :href="route('languages.index')" :active="$page.url == '/admin/setting/language' || $page.url == '/admin/setting/language'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-language nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Theme" :href="route('admin.themes.index')" :active="$page.url == '/admin/setting/theme'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-language nav-icon"></i>
                        </template>
                    </NavLink>
                     <!-- <NavLink title="Setting" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gear nav-icon"></i>
                        </template>
                    </NavLink> -->
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
