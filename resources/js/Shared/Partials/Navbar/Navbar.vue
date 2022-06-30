<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a v-tooltip="'Collapse Sidebar'" @click="sidebarCollapse" class="nav-link" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <!-- Url - {{ $page.url }} <br>
            Component - {{ $page.component }} <br>
            {{ $page.component == 'company/teams' ? 'active':'active na' }} -->
            <!-- {{ $page.component == '/employee/leaveRequest/index' || $page.component == '/employee/leaveRequest/create' || $page.component == '/employee/leaveRequest/edit' ? 'active':'active na' }} -->
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <LanguageSelector/>
            <QuickAction />
            <Appearance />
            <Notification />
            <UserMenu />
        </ul>
    </nav>
</template>

<script>
import QuickAction from "./QuickAction.vue";
import Appearance from "./Appearance.vue";
import UserMenu from "./UserMenu.vue";
import Notification from "./Notification.vue";
import LanguageSelector from "./LanguageSelector.vue";

export default {
    components: {
        QuickAction,
        Appearance,
        UserMenu,
        Notification,
        LanguageSelector,
    },
    methods: {
        sidebarCollapse() {
            let sidebarCollapse = localStorage.getItem("sidebarCollapse");

            if (sidebarCollapse === "true") {
                localStorage.setItem("sidebarCollapse", "false");
                document.body.classList.remove("sidebar-collapse");
            } else {
                localStorage.setItem("sidebarCollapse", "true");
                document.body.classList.add("sidebar-collapse");
            }
        },
    },
};
</script>
