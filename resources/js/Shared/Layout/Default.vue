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
                    <div class="alert alert-danger py-3" role="alert" v-if="role == 'owner' && $page.props.current_subscription && $page.props.current_subscription.plan_expired">
                        {{ __('Plan is expired. Please upgrade your plan') }}
                        <Link :href="route('company.billing')" class="">
                            {{ __('Upgrade Now') }}
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </Link>
                    </div>

                    <slot />
                </div>
            </div>
        </div>

        <Footer/>
    </div>
</template>

<script>
import Navbar from "../Partials/Navbar/Navbar.vue";
import Menubar from "../Partials/Menubar/Menubar.vue";
import Footer from "../Partials/Footer.vue";
import Breadcrumb from "../Breadcrumb.vue";
import LanguageSelector from "../Partials/Navbar/LanguageSelector.vue";

export default {
    components: {
        Navbar,
        Menubar,
        Footer,
        Breadcrumb,
        LanguageSelector,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
        };
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
