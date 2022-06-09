<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index3.html" class="brand-link">
            <img :src="employeeCompanyUser.avatar" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ employeeCompanyUser.name }}</span>
        </a>
        <div class="sidebar" style="overflow-y: auto;">

            <nav class="sidebar-main-nav mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat nav-child-indent"
                    data-widget="treeview" role="menu" data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>

                    <NavLink title="My Team" :href="route('holidays.index')"
                        :active="$page.url == '/employee/holidays'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Reports" :href="route('holidays.index')"
                        :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
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
                    <NavLink title="Announcement" :href="route('holidays.index')"
                        :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-bullhorn nav-icon"></i>
                        </template>
                    </NavLink>
                    <li class="nav-item">
                        <Link href="/logout" class="nav-link" method="post">
                        <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                        <p>Logout</p>
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
            role: this.$page.props.user.role,
            user: this.$page.props.user,
            employeeCompanyUser: this.$page.props.employeeCompanyUser,
        };
    },
};
</script>
