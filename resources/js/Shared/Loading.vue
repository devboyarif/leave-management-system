<template>
    <i class="fa-solid fa-spinner fa-spin mr-1" :class="size"></i>
    <span v-if="messageShow">{{ message }}</span>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: "Processing...",
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
