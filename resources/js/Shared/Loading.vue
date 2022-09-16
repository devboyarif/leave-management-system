<template>
    <span class="input-icon-addon">
        <div class="spinner-border spinner-border-sm mr-1" role="status"></div>
    </span>
    <span v-if="messageShow">{{ message }}</span>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: "Saving...",
        },
        messageShow: {
            type: Boolean,
            default: true,
        },
        size: {
            type: String,
            default: "fa-1x",
        },
    },
};
</script>

<style scoped>
.spinner-border-sm {
    width: 20px;
    height: 20px;
    border-width: 0.2em;
}
</style>
