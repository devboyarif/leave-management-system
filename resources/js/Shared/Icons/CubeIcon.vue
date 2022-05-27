<template>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" :class="classes" :width="width" :height="height" viewBox="0 0 24 24" stroke-width="2" :stroke="stroke" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
        <line x1="12" y1="12" x2="20" y2="7.5"></line>
        <line x1="12" y1="12" x2="12" y2="21"></line>
        <line x1="12" y1="12" x2="4" y2="7.5"></line>
    </svg>
</template>

<script>
    export default {
        props: {
            classes: {
                type: String,
                required: false,
            },
            height: {
                type: Number,
                default: 24,
                required: false,
            },
            width: {
                type: Number,
                default: 24,
                required: false,
            },
            stroke: {
                type: String,
                default: 'currentColor',
                required: false,
            }
        }
    }
</script>
