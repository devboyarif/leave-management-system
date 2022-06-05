<template>
    <button v-if="leaveRequest.status == 'pending' || leaveRequest.status == 'rejected'" @click="statusChange('approved')" v-tooltip="'Accept Request'" class="btn btn-sm">
        <i class="fa-solid fa-check fa-2x accept-request"></i>
    </button>
    <button v-if="leaveRequest.status == 'pending' || leaveRequest.status == 'approved'" @click="statusChange('rejected')" v-tooltip="'Reject Request'" class="btn btn-sm mx-1">
        <i class="fa-solid fa-xmark fa-2x reject-request"></i>
    </button>
    <button @click="editData('edit')" v-tooltip="'Edit Request'" class="btn btn-sm mx-1">
        <i class="fa-solid fa-pen-to-square fa-2x edit-request"></i>
    </button>
    <button @click="deleteData()" v-tooltip="'Delete Request'" class="btn btn-sm mx-1">
        <i class="fa-solid fa-trash-can fa-2x delete-request"></i>
    </button>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        leaveRequest: {
            type: Object,
            required: true,
        },
    },
    components: {
        Inertia,
    },
    methods: {
        statusChange(status) {
            Inertia.post(route("leaveRequests.status"), {
                id: this.leaveRequest.id,
                status: status,
            });
        },
        editData() {},
        deleteData() {
            // this.$toast.success(`Hey! I'm here`);
            // this.toastSuccess();
            // this.toastError();
            // this.toastError();
            // this.showSweetAlert();
            // this.$swal({
            //     title: "Are you sure?",
            //     text: "You won't be able to revert this!",
            //     icon: "warning",
            //     showCancelButton: true,
            //     confirmButtonColor: "#3085d6",
            //     cancelButtonColor: "#d33",
            //     confirmButtonText: "Yes, delete it!",
            // }).then((result) => {
            //     console.log(result);
            //     if (result.isConfirmed) {
            //         Inertia.delete(
            //             route("leaveRequests.destroy", this.leaveRequest.id)
            //         );
            //     }
            // });
        },
    },
};
</script>

<style scoped>
    .accept-request {
        color: #28a745;
    }

    .reject-request {
        color: #dc3545;
    }

    .edit-request {
        color: #007bff;
    }
    .delete-request {
        color: #dc3545;
    }
</style>
