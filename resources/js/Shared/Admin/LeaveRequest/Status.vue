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
    <button @click="deleteData()" v-tooltip="__('Delete')" class="btn btn-sm">
        <DeleteIcon/>
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
            this.$inertia.post(route("leaveRequests.status"), {
                id: this.leaveRequest.id,
                status: status,
            });
        },
        editData(leaveRequestId) {
            this.$inertia.get(route("leaveRequests.edit", leaveRequestId));
        },
        deleteData() {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(
                        route("leaveRequests.destroy", this.leaveRequest.id),
                        {
                            preserveScroll: true,
                        }
                    );
                }
            });
        },
    },
};
</script>
