<template>
    <span v-if="name" :class="className">{{ name }}</span>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        className: {
            type: String,
            default: "invalid-feedback",
        },
    },
};
</script>
