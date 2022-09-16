<template>
    <Head :title="user.name" />
    <EmployeeDetails :user="user" :summary="summary" :leaveBalances="leave_balances"/>
</template>

<script>
    import EmployeeDetails from "../../Shared/Employee/Details.vue"

    export default {
        props: {
            user: Object,
            summary: Object,
            leave_balances: Array,
        },
        components:{
            EmployeeDetails
        },
        mounted() {
            this.checkPagePermission("owner")
        },
    };
</script>
