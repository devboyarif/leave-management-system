<template>
    <!-- <span v-if="name" :class="className">{{ name }}</span> -->
    <span v-if="name" :class="['d-block text-danger mt--10 mb-1', className]" class="">{{ name }}</span>
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
            default: "",
        },
    },
};
</script>
