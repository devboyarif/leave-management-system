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
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>
                     <Dropdown title="Leave" :active="$page.url == '/admin/leaveTypes/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-plane-departure nav-icon"></i>
                        </template>
                        <NavLink title="Leave Type" :href="route('leaveTypes.index')" :active="$page.url == '/admin/leaveTypes/*'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Leave Request" :href="route('leaveRequests.index')" :active="$page.component == 'company/index'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                    <NavLink title="Employees" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Teams" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                          <i class="fa-solid fa-people-group nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Reports" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Holidays" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-h nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Announcement" :href="route('holidays.index')" :active="$page.url == '/admin/holidays' || $page.url == '/admin/holidays/*'">
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
            role: this.$page.props.authenticatedUser.role,
        };
    },
};
</script>
