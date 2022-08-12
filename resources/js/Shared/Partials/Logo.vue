<template>
     <img :src="setting.app_dark_logo" alt="logo" class="auto-logo">
</template>

<script>
export default {
    data() {
        return {
            setting: {},
        };
    },
    async mounted() {
        let response = await axios.get(route("app.setting"));
        this.setting = response.data;
    },
};
</script>

<style scoped>
    .auto-logo{
        width: 160px;
        height: 55px;
        object-fit: cover
    }
</style>
