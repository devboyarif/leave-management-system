<template>
    <Head :title="user.name" />

    <div class="row gutters-sm p-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img :src="user.company_logo" alt="logo" class="rounded-circle object-fit-cover" width="150" height="150">
                        <div class="mt-3">
                            <h4>{{ user.company_name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Expense') }}
                            </h5>
                            <b>{{ currencyPosition(summary.total_expense) }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Teams') }}
                            </h5>
                            <b>{{ summary.total_teams }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Employees') }}
                            </h5>
                            <b>{{ summary.total_employees }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Holidays') }}
                            </h5>
                            <b>{{ summary.total_holidays }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Total Leave Types') }}
                            </h5>
                            <b>{{ summary.total_leave_types }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Pending Leave Requests') }}
                            </h5>
                            <b>{{ summary.total_pending_leave_requests }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
                            <h5 class="mb-0">
                                {{ __('Approved Leave Requests') }}
                            </h5>
                            <b>{{ summary.total_approved_leave_requests }}</b>
                        </a>
                    </li>
                    <li class="list-group-item flex-wrap">
                        <a href="javascript:void(0)" class="d-flex justify-content-between align-items-center text-dark">
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
                            {{ user.company_name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Email') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.company_email }}
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
                            <button @click="deleteCompany(user.id)" v-tooltip="'Delete'" class="btn">
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
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span>{{ __('Currently Subscribed') }}</span>
                                <Link @click="details('order')" class="btn btn-primary">{{ __('Order List') }}</Link>
                            </h4>
                            <table class="table border-0">
                                <tbody>
                                    <tr v-if="subscribed_plan.plan">
                                        <th>{{ __('Plan') }}</th>
                                        <td>{{ subscribed_plan.plan.name }}</td>
                                    </tr>
                                    <tr v-if="subscribed_plan.plan">
                                        <th>{{ __('Subscription Type') }}</th>
                                        <td>
                                            <span v-if="subscribed_plan.plan.interval == 'custom_days'">
                                            {{ subscribed_plan.plan.custom_interval_days }} {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                            </span>
                                            <span v-else class="text-capitalize">{{ subscribed_plan.plan.interval }}</span>
                                        </td>
                                    </tr>
                                    <tr v-if="subscribed_plan.plan && subscribed_plan.plan.interval != 'lifetime'">
                                    <th>{{ __('Expiration Remaining') }}</th>
                                        <td>{{ subscribed_plan.remaining_days }}
                                        <span v-if="subscribed_plan.remaining_days != 'Lifetime'">
                                            {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                        </span>
                                        </td>
                                    </tr>
                                    <tr>
                                    <th width="40%">{{ __('Plan Features') }}</th>
                                        <td>
                                            <Feature :span-text="true" name="Unlimited Employees" :checked="!subscribed_plan.plan.plan_features.is_limited_employee"/>
                                            <Feature :span-text="true" name="Max Employees" :checked="true" :value="subscribed_plan.plan.plan_features.is_limited_employee ? subscribed_plan.plan.plan_features.max_employees : '∞'"/>
                                            <Feature :span-text="true" name="Max Teams" :checked="true" :value="subscribed_plan.plan.plan_features.max_teams"/>
                                            <Feature :span-text="true" name="Max Leave Types" :checked="true" :value="subscribed_plan.plan.plan_features.max_leave_types"/>
                                            <Feature :span-text="true" name="Custom Theme Look" :checked="subscribed_plan.plan.plan_features.custom_theme_look"/>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
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
            subscribed_plan: Object,
        },
        components: {
            Feature
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
                    case 'order':
                        this.$inertia.get(route("orders.index"), {
                            'company': this.user.company.id,
                        })
                        break;

                    default:
                        break;
                }
            },
        }
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
