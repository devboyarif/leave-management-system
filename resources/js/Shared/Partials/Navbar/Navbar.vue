<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <QuickAction/>
            <LanguageSwitcher/>
            <Appearance/>
            <UserMenu/>
        </ul>
    </nav>
</template>

<script>
import QuickAction from "./QuickAction.vue";
import LanguageSwitcher from "./LanguageSwitcher.vue";
import Appearance from "./Appearance.vue";
import UserMenu from "./UserMenu.vue";

export default {
    components: {
        QuickAction,
        LanguageSwitcher,
        Appearance,
        UserMenu,
    },
};
</script>
