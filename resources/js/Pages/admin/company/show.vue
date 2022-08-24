<template>

    <Head :title="user.name" />

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
                        <a @click="details('team')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Teams') }}
                            </h5>
                            <b>{{ summary.total_teams }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a @click="details('employee')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Employees') }}
                            </h5>
                            <b>{{ summary.total_employees }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a @click="details('holiday')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Holidays') }}
                            </h5>
                            <b>{{ summary.total_holidays }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a @click="details('leave_type')" href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Leave Types') }}
                            </h5>
                            <b>{{ summary.total_leave_types }}</b>
                        </a>
                    </li>
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
                    <template v-if="user.company && user.company.country">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">{{ __('Country') }}</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ user.company.country.name }}
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
                            <Link :href="route('companies.edit',user.id)" v-tooltip="'Edit'" class="btn pl-0">
                            <EditIcon />
                            </Link>
                            <button @click="deleteCompany(user.id)" v-tooltip="'Delete'" class="btn"
                                v-if="user.id != auth_user.id">
                                <DeleteIcon />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="d-flex align-items-center mb-3">{{ __('Working Days') }}</h4>
                            <hr>
                            <Feature name="Sunday" :checked="working_days.sunday" />
                            <Feature name="Monday" :checked="working_days.monday" />
                            <Feature name="Tuesday" :checked="working_days.tuesday" />
                            <Feature name="Wednesday" :checked="working_days.wednesday" />
                            <Feature name="Thursday" :checked="working_days.thursday" />
                            <Feature name="Friday" :checked="working_days.friday" />
                            <Feature name="Saturday" :checked="working_days.saturday" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="d-flex align-items-center mb-3"><i
                                    class="material-icons text-info mr-2">assignment</i>Project Status</h6>
                            <small>Web Design</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Website Markup</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 72%"
                                    aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>One Page</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 89%"
                                    aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Mobile Template</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 55%"
                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small>Backend API</small>
                            <div class="progress mb-3" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 66%"
                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</template>


<script>
    import Feature from "../../../Shared/Admin/Plan/Feature.vue";

    export default {
        props: {
            user: Object,
            working_days: Object,
            summary: Object,
        },
        components: {
            Feature
        },
        data() {
            return {
                auth_user: this.$page.props.authenticatedUser
            };
        },
        methods: {
            deleteCompany(id) {
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
                        this.$inertia.delete(route("companies.destroy", id));
                    }
                });
            },
            details(value) {
                switch (value) {
                    case 'team':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;
                    case 'employee':
                        this.$inertia.get(route('employees.index'), {
                            'company': this.user.company.id
                        })
                        break;
                    case 'holiday':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;
                    case 'leave_type':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;
                    case 'pending_leave':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;
                    case 'approve_leave':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;
                    case 'reject_leave':
                        this.$inertia.get(route('teams.index'), {
                            'user_id': this.user.id
                        })
                        break;

                    default:
                        break;
                }
            },
        },
        mounted() {
            // this.checkPagePermission("admin");
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
