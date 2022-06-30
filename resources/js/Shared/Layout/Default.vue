<template>
    <div class="wrapper">
        <!-- Navbar -->
        <Navbar/>

        <!-- Main Sidebar Container -->
        <Menubar/>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    Locale: {{ $page.props.locale }} <br>
                    <!-- En Languages: {{ $page.props.en_language }} <br>
                    De Languages: {{ $page.props.de_language }} <br> -->
                    <span>{{ __('My Profile') }}</span>

                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../Partials/Navbar/Navbar.vue";
import Menubar from "../Partials/Menubar/Menubar.vue";
import Breadcrumb from "../Breadcrumb.vue";
import LanguageSelector from "../Partials/Navbar/LanguageSelector.vue";

//
export default {
    components: {
        Navbar,
        Menubar,
        Breadcrumb,
        LanguageSelector,
    },
    watch: {
        pageFlashes: {
            handler(flashes) {
                if (flashes.success) {
                    this.toastSuccess(flashes.success);
                }
                if (flashes.error) {
                    this.toastError(flashes.error);
                }
                if (flashes.warning) {
                    this.toastWarning(flashes.warning);
                }
            },
            deep: true,
        },
    },
    mounted() {
        document.body.classList.add("sidebar-mini", "layout-fixed");

        let sidebarCollapse = localStorage.getItem("sidebarCollapse");
        if (sidebarCollapse === "true") {
            document.body.classList.add("sidebar-collapse");
        } else {
            document.body.classList.remove("sidebar-collapse");
        }
    },
};
</script>
