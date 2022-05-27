<template>
    <div class="wrapper">
        <!-- Navbar -->
        <Navbar/>

        <!-- Main Sidebar Container -->
        <Menubar/>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
                        {{ $page.props.flash.success }}
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
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

export default {
    components: {
        Navbar,
        Menubar,
        Breadcrumb,
    },
};
</script>

<style>
    @import '../../../../public/admin/css/adminlte.min.css';
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css";
</style>
