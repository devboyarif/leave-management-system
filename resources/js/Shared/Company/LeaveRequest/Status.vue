<template>
    <button v-if="leaveRequest.status == 'pending' || leaveRequest.status == 'rejected'" @click="statusChange('approved')" v-tooltip="__('Accept Request')" class="btn btn-sm">
        <CheckIcon/>
    </button>
    <button v-if="leaveRequest.status == 'pending' || leaveRequest.status == 'approved'" @click="statusChange('rejected')" v-tooltip="__('Reject Request')" class="btn btn-sm ">
        <CrossIcon/>
    </button>
    <button v-if="leaveRequest.status == 'pending'" @click="editData(leaveRequest.id)" v-tooltip="__('Edit')" class="btn btn-sm">
        <EditIcon/>
    </button>
</template>

<script>
export default {
    props: {
        leaveRequest: {
            type: Object,
            required: true,
        },
    },
    methods: {
        statusChange(status) {
            this.$inertia.post(route("company.leaveRequests.status"), {
                id: this.leaveRequest.id,
                status: status,
            });
        },
        editData(leaveRequestId) {
            this.$inertia.get(
                route("company.leaveRequests.edit", leaveRequestId)
            );
        }
    },
};
</script>
