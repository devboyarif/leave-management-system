<template>
    <label :class="className" :for="forName ? forName:name">
        <b>{{ name }}</b>
        <span v-if="required" class="text-danger pl-1">*</span>
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
           default: "text-secondary",
       },
       forName: {
           type: String,
           default: "",
       },
   },
};
</script>
