<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

         <Link :href="route('dashboard')" class="brand-link">
            <img :src="setting.app_favicon" alt="logo" class="brand-image img-circle">
            <span class="brand-text font-weight-bold">{{ setting.app_name }}</span>
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
                    <NavLink title="Reports" :href="route('company.reports.index')"
                        :active="$page.component == 'company/reports/index' || $page.component == 'company/reports/employeeLeaveBalance' || $page.component == 'company/reports/employeeLeaveHistory' || $page.component == 'company/reports/teamLeaveBalance' || $page.component == 'company/reports/teamLeaveHistory'">
                        <template v-slot:icon>
                            <i class="fa-regular fa-calendar-days nav-icon"></i>
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

                    <!-- Subscription Part  -->
                    <li class="nav-header">{{ __('Billing') }}</li>
                    <NavLink title="Billing" :href="route('company.billing')"
                        :active="$page.component == 'company/billing'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-chart-pie nav-icon"></i>
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
            setting: this.$page.props.setting,
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
    watch: {
        role: function(){
            this.role = this.$page.props.authenticatedUser.role
        }
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


    .css-btvco8 {
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        margin: 8px 0px;
        padding: 0px 19px;
    }
    .css-bjn8wh {
        position: relative;
    }

    .css-8dsptl {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        border: none;
        padding: 0px;
        background: none;
        width: 100%;
    }

    .css-a4lfgh {
        flex-shrink: 0;
        border: none;
        margin: 2px 12px 2px 0px;
        box-shadow: rgb(0 0 0 / 8%) 0px 2px 0px;
        border-radius: 6px;
    }

    .avatar {
        display: inline-block;
        height: 20px;
        position: relative;
        vertical-align: middle;
        width: 20px;
    }

    .css-1jewg5y {
        overflow-x: hidden;
        text-align: left;
    }

    .css-1q83d1c {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: auto;
        font-size: 16px;
        line-height: 1.2;
        font-weight: bold;
        color: rgb(255, 255, 255);
        text-shadow: rgb(255 255 255 / 0%) 0px 0px 6px;
        transition: text-shadow 0.15s linear 0s;
    }

    .css-11eyjwm {
        transition: transform 120ms ease-in-out 0s;
        transform: rotate(180deg);
        margin-left: 2px;
    }

    .css-1oxl8yb {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: auto;
        font-size: 14px;
        line-height: 16px;
        transition: color 0.15s linear 0s;
    }










    .css-1q6u83e {
    position: absolute;
    background: rgb(255, 255, 255);
    color: rgb(62, 52, 70);
    border-radius: 4px;
    box-shadow: rgb(0 0 0 / 8%) 0px 0px 0px 1px, rgb(0 0 0 / 30%) 0px 4px 20px 0px;
    padding: 5px 0px;
    width: 250px;
    top: 42px;
    min-width: 180px;
    z-index: 1030;
}

.css-g2azat {
    display: grid;
    grid-template-columns: max-content minmax(0px, 1fr);
    gap: 8px;
    -webkit-box-align: center;
    align-items: center;
    padding: 8px 15px;
}

.css-1demj03 {
    flex-shrink: 0;
    border-radius: 3px;
    border: none;
}

.css-1m9umwh {
    position: absolute;
    top: 0px;
    left: 0px;
    border-radius: 3px;
}

.css-svokod {
    color: rgb(62, 52, 70);
    font-size: 16px;
    line-height: 1.1;
    font-weight: bold;
    display: block;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.css-c2pm1j {
    color: rgb(128, 112, 143);
    font-size: 14px;
    line-height: 1;
    margin-top: 4px;
    display: block;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.css-69tfkj {
    border-radius: 4px;
    color: rgb(62, 52, 70);
    cursor: pointer;
    display: flex;
    font-size: 14px;
    line-height: 32px;
    padding: 0px 15px;
    position: relative;
    transition: all 0.1s linear 0s;
    overflow: hidden;
}


































</style>
