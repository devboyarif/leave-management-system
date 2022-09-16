<template>
    <div class="row gutters-sm p-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img :src="user.avatar" alt="logo" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{ user.name }}</h4>
                            <p class="text-secondary mb-1 text-uppercase" v-tooltip="__('Role')">
                                <span class="badge badge-primary">{{ user.role }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item flex-wrap">
                        <a @click="details('pending_leave')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Pending Leave Requests') }}
                            </h5>
                            <b>{{ summary.total_pending_leave_requests }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a @click="details('approve_leave')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Approved Leave Requests') }}
                            </h5>
                            <b>{{ summary.total_approved_leave_requests }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a @click="details('reject_leave')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Rejected Leave Requests') }}
                            </h5>
                            <b>{{ summary.total_rejected_leave_requests }}</b>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
             <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Name') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Email') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.email }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Phone') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.employee.phone }}
                        </div>
                    </div>
                    <hr>
                    <template v-if="user.employee && user.employee.team">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">{{ __('Team') }}</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ user.employee.team.name }}
                            </div>
                        </div>
                        <hr>
                    </template>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Joining Date') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ timeFromNow(user.created_at) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Last Profile Update') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ timeFromNow(user.updated_at) }}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <button @click="deleteEmployee(user.id)" v-tooltip="'Delete'" class="btn">
                                <DeleteIcon />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gutters-sm">
        <div class="col-sm-12 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="d-flex align-items-center mb-3">{{ __('Leave Balance') }}</h4>
                    <table class="table table-bordered">
                        <tr class="h5">
                            <th>{{ __('Leave Type') }}</th>
                            <th>{{ __('Remaining Days') }}</th>
                            <th>{{ __('Used Days') }}</th>
                            <th>{{ __('Total Days') }}</th>
                        </tr>
                        <tr v-for="leave_balance in leave_balances" :key="leave_balance.id">
                            <td>{{ leave_balance.leave_type.name }}</td>
                            <td>{{ leave_balance.remaining_days }}</td>
                            <td>{{ leave_balance.used_days }}</td>
                            <td>{{ leave_balance.total_days }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
            summary: Object,
            leave_balances: Array,
        },
        methods: {
             deleteEmployee(id) {
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
                        this.$inertia.delete(route("employees.destroy", id));
                    }
                });
            },
        },
    };
</script>

<style scoped>
    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
</style>
