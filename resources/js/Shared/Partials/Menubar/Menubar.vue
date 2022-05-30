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
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="$page.props.user.avatar" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> {{ $page.props.user.name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <NavLink title="Dashboard" :href="route('dashboard')" :active="$page.component == 'dashboard'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>
                    <Dropdown title="Pages" :active="$page.component == 'about' || $page.component == 'contact'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-cube nav-icon"></i>
                        </template>
                        <NavLink title="About" :href="route('about')" :active="$page.component == 'about'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Contact" :href="route('contact')" :active="$page.component == 'contact'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                    <Dropdown title="Users" :active="$page.component == 'about' || $page.component == 'contact'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-user-group nav-icon"></i>
                        </template>
                        <NavLink title="Admin" :href="route('admins.index')" :active="$page.component == 'user/index' || $page.component == 'user/create' || $page.component == 'user/edit'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Company" :href="route('companies.index')" :active="$page.component == 'company/index'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                        <NavLink title="Employee" :href="route('employees.index')" :active="$page.component == 'employee/index'">
                            <template v-slot:icon>
                                <i class="far fa-circle nav-icon"></i>
                            </template>
                        </NavLink>
                    </Dropdown>
                       <NavLink title="Team" :href="route('teams.index')" :active="$page.component == 'team/index'">
                        <template v-slot:icon>
                           <i class="fa-solid fa-gauge-high nav-icon"></i>
                        </template>
                    </NavLink>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import IconHome from "../../Icons/HomeIcon.vue";
import IconCircle from "../../Icons/CircleIcon.vue";
import IconChevronDown from "../../Icons/ChevronDownIcon.vue";
import IconChevronUp from "../../Icons/ChevronUpIcon.vue";
import IconChevronLeft from "../../Icons/ChevronLeftIcon.vue";
import IconCube from "../../Icons/CubeIcon.vue";
import Dropdown from "./Dropdown.vue";
import NavLink from "./NavItem.vue";

export default {
    components: {
        IconHome,
        IconCircle,
        IconChevronUp,
        IconChevronDown,
        IconChevronLeft,
        IconCube,
        Dropdown,
        NavLink,
    },
    data() {
        return {
            menuOpen: false,
        };
    },
};
</script>
