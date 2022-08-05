<template>
<div class="container mt-3 pt-3">
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
};
</script>

<style>
    .login-box {
        width: 500px;
    }
</style>
