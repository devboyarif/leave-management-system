<template>
    <AdminDashboard v-if="role == 'admin'"/>
    <CompanyDashboard v-else-if="role == 'owner'"/>
    <EmployeeDashboard v-else/>
</template>

<script>
import AdminDashboard from "../Shared/Admin/Dashboard.vue";
import CompanyDashboard from "../Shared/Company/Dashboard.vue";
import EmployeeDashboard from "../Shared/Employee/Dashboard.vue";

export default {
    components: {
        AdminDashboard,
        CompanyDashboard,
        EmployeeDashboard,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
        };
    },
};
</script>
