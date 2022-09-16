<template>
    <nav class="main-header navbar navbar-expand navbar-light" id="navbar">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a v-tooltip="'Collapse Sidebar'" @click="sidebarCollapse" class="nav-link" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
            </li>
             <li class="nav-item">
                <a v-tooltip="'Browse Website'" target="_blank" class="nav-link" href="/">
                    <i class="fa-solid fa-globe fa-2"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <LanguageSelector/>
            <Appearance />
            <Notification />
            <UserMenu />
        </ul>
    </nav>
</template>

<script>
import Appearance from "./Appearance.vue";
import UserMenu from "./UserMenu.vue";
import Notification from "./Notification.vue";
import LanguageSelector from "./LanguageSelector.vue";

export default {
    components: {
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
