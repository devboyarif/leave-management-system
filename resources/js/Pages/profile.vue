<template>
    <Head :title="__('Profile')" />
    <AdminProfile :user="user" v-if="role == 'admin'"/>
    <CompanyProfile :user="user" :countries="countries" v-else-if="role == 'owner'"/>
    <EmployeeProfile :user="user" v-else/>
</template>

<script>
import AdminProfile from "../Shared/Admin/Profile.vue";
import CompanyProfile from "../Shared/Company/Profile.vue";
import EmployeeProfile from "../Shared/Employee/Profile.vue";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
        countries: {
            type: Array,
            required: false,
        },
    },
    components: {
        AdminProfile,
        CompanyProfile,
        EmployeeProfile,
    },
    data() {
        return {
            role: this.$page.props.authenticatedUser.role,
        };
    },
};
</script>
