<template>
     <label :class="className" :for="forName ? forName:name">
        {{ name }}
        <span v-if="required" class="text-danger">*</span>
        <slot/>
    </label>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        required: {
            type: Boolean,
            default: true,
        },
        className: {
            type: String,
            default: "form-label",
        },
        forName: {
            type: String,
            default: "",
        },
    },
};
</script>
