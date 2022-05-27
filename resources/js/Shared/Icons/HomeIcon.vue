<template>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" :class="classes" :width="width" :height="height" viewBox="0 0 24 24" stroke-width="2" :stroke="stroke" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
</template>

<script>
export default {
    props:{
        classes: {
            type: String,
            required: false,
        },
        height:{
            type: Number,
            default: 24,
            required: false,
        },
        width:{
            type: Number,
            default: 24,
            required: false,
        },
        stroke:{
            type: String,
            default: 'currentColor',
            required: false,
        }
    }
}
</script>
