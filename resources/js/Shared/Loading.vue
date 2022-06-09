<template>
    <i class="fa-solid fa-spinner fa-spin mr-1"></i> {{ message }}
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: "Processing...",
        },
    },
};
</script>
