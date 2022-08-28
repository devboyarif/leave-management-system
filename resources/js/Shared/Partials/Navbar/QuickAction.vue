<template>
    <AdminQuickAction v-if="role == 'admin'"/>
    <CompanyQuickAction v-else-if="role == 'owner'"/>
</template>

<script>
import AdminQuickAction from "./Role/AdminQuickAction.vue";
import CompanyQuickAction from "./Role/CompanyQuickAction.vue";

export default {
    name: "quick-action",
    components: {
        AdminQuickAction,
        CompanyQuickAction,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
        };
    },
};
</script>
