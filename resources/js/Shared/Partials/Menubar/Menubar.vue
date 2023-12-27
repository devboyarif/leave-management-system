<template>
    <AdminMenuBar v-if="role == 'admin'"/>
    <CompanyMenuBar v-else-if="role == 'owner'"/>
    <EmployeeMenuBar v-else/>
</template>

<script>
import AdminMenuBar from "./Role/AdminMenuBar.vue";
import CompanyMenuBar from "./Role/CompanyMenubar.vue";
import EmployeeMenuBar from "./Role/EmployeeMenubar.vue";

export default {
    components: {
        AdminMenuBar,
        CompanyMenuBar,
        EmployeeMenuBar,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
        };
    },
};
</script>
