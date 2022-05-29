<template>
<div class="container mt-5 pt-5">
    <div class="mt-5 pt-2 row align-items-center justify-content-center">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>Admin</b>LTE</a>
                </div>
                <slot />
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    components: {},
};
</script>

<style>
    @import '../../../../public/admin/css/adminlte.min.css';
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css";

    .login-box {
        width: 400px;
    }
</style>
