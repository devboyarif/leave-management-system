<template>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" :class="classes" :width="width" :height="height"
        viewBox="0 0 24 24" stroke-width="2" :stroke="stroke" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <polyline points="15 6 9 12 15 18" />
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
