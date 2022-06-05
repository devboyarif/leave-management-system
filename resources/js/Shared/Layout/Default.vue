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
                // console.log(flashes.success);
                // alert();
                // _.each(flashes, (flash, index) => {
                //     this.$toasted.global[index](flash);
                //     this.pageFlashes = "EMPTY";
                // });
            },
            deep: true,
        },
    },
};
</script>

<style>
    @import '../../../../public/admin/css/adminlte.min.css';
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css";
</style>
