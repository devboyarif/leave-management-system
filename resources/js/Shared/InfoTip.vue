<template>
    <span v-tooltip="title">
        <InfoIcon />
    </span>
</template>

<script>
import InfoIcon from "./Icons/InfoIcon.vue";

export default {
    components: {InfoIcon},
    props: {
        title: {
            type: String,
            default: '',
        }
    }
}
</script>
