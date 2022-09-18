<template>
    <Head :title="__('Billing')" />

    <div class="row pt-4 billing">
        <div class="col-lg-4 mb-4">
            <!-- Billing card 1-->
            <div class="card h-100 border-start-lg border-start-primary">
                <div class="card-body">
                    <h5>{{ __('Current bill') }}</h5>
                    <div class="h3">{{ currencyPosition(currently_subscribed.plan.price) }}</div>
                    <a class="text-arrow-icon small" href="#pricing_plan">
                        {{ __('Switch to another plan') }}
                        <ArrowRight/>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <!-- Billing card 2-->
            <div class="card h-100 border-start-lg border-start-secondary">
                <div class="card-body">
                    <h5>{{ __('Next payment due') }}</h5>
                    <div class="h3">
                        <template v-if="currently_subscribed.plan && currently_subscribed.plan.interval != 'lifetime'">
                            {{ formateDate(currently_subscribed.expired_date, "MMMM D") }}
                            <span class="badge badge-danger" v-if="currently_subscribed.plan_expired">{{ __('Expired') }}</span>
                            <span class="badge badge-success" v-else>{{ __('Active') }}</span>
                        </template>
                        <span v-else>{{ __('Lifetime') }}</span>
                    </div>
                    <a class="text-arrow-icon small text-secondary" href="#billing_history">
                        {{ __('View billing history') }}
                       <ArrowRight/>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <!-- Billing card 3-->
            <div class="card h-100 border-start-lg border-start-success">
                <div class="card-body">
                    <h5>{{ __('Current Plan') }}</h5>
                    <div class="h3 d-flex align-items-center" v-if="currently_subscribed.plan">
                        {{ currently_subscribed.plan.name }}
                    </div>
                    <a class="text-arrow-icon small text-success" :href="route('website.plan.details', currently_subscribed.plan.slug)">
                       {{ __('Upgrade plan') }}
                       <ArrowRight/>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" id="pricing_plan">
       <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Pricing Plan') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12" v-for="plan in plans" :key="plan.id">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header text-center py-4">
                                    <h5>
                                        <b>{{ plan.name }}</b>
                                        <small v-if="plan.interval != 'custom_days'"> /{{ plan.interval }}</small>
                                        <small v-else> /{{ plan.custom_interval_days }} {{ __('Days') }}</small>
                                    </h5>
                                    <div class="badge badge-info" v-if="plan.recommended">{{ __('Recommended') }}</div>
                                    <h1>
                                        {{ currencyPosition(plan.price) }}
                                    </h1>
                                </div>
                                <div class="card-body" v-if="plan.plan_features">
                                <Feature name="Unlimited Employees" :checked="!plan.plan_features.is_limited_employee"/>
                                <Feature name="Max Employees" :checked="true" :value="plan.plan_features.is_limited_employee ? plan.plan_features.max_employees : '∞'"/>
                                <Feature name="Max Teams" :checked="true" :value="plan.plan_features.max_teams"/>
                                <Feature name="Max Leave Types" :checked="true" :value="plan.plan_features.max_leave_types"/>
                                <Feature name="Custom Theme Look" :checked="plan.plan_features.custom_theme_look"/>
                                </div>
                                <div class="card-footer">
                                    <div class=" d-flex justify-content-between">
                                        <template v-if="subscription.plan_id == plan.id">
                                        <a :href="route('website.plan.details', plan.slug)" type="button" class="btn btn-success">
                                            {{ __('Current Plan') }}
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                        </template>
                                        <a v-else :href="route('website.plan.details', plan.slug)" class="btn btn-primary">
                                            {{ __('Select Plan') }}
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                        <template v-if="currently_subscribed.plan && currently_subscribed.plan.interval != 'lifetime'">
                                            <a href="javascript:void(0)" class="btn btn-danger" v-if="currently_subscribed.plan_id == plan.id">
                                                {{ __('Expire In') }} - {{ currently_subscribed.remaining_days }} {{ __('Days') }}
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>

    <div class="row justify-content-center" id="billing_history">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Billing History') }}</h3>
                        <div>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link v-if="filterForm.search || filterForm.payment || filterForm.plan" :href="route('company.billing')" class="btn btn-danger ml-2" preserve-scroll>
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom row" v-if="showFilter">
                    <div class="col-4">
                        <label>{{ __('Search') }}</label>
                        <input @keyup="searchData" v-model="filterForm.search" type="text" placeholder="Search order id, transaction id" class="form-control">
                    </div>
                    <div class="col-4">
                        <label>{{ __('Plan') }}</label>
                        <select v-model="filterForm.plan" class="form-control" @change="filterData">
                            <option value="">{{ __('All') }}</option>
                            <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                                {{ plan.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>{{ __('Payment') }}</label>
                        <select class="form-control" v-model="filterForm.payment" @change="filterData">
                            <option value="">{{ __('All') }}</option>
                            <option value="paypal">{{ __('Paypal') }}</option>
                            <option value="stripe">{{ __('Stripe') }}</option>
                            <option value="flutterwave">{{ __('Flutterwave') }}</option>
                            <option value="mollie">{{ __('Mollie') }}</option>
                            <option value="midtrans">{{ __('Midtrans') }}</option>
                            <option value="paystack">{{ __('Paystack') }}</option>
                            <option value="razorpay">{{ __('Razorpay') }}</option>
                            <option value="instamojo">{{ __('Instamojo') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="orders && orders.data.length">
                                <tr v-for="(order,index) in orders.data" :key="index">
                                    <td>
                                        <Link :href="route('company.orders.show',order.id)" v-tooltip="__('Order Details')">
                                            #<span v-html="order.order_id"></span>
                                        </Link>
                                    </td>
                                    <td><span v-html="order.transaction_id"></span></td>
                                    <td>
                                        {{ order.currency_symbol }}&nbsp;{{ order.amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ order.payment_provider }}
                                    </td>
                                    <td v-if="order.plan">
                                        <b>{{ order.plan.name }}</b>
                                        /
                                        <small v-if="order.plan.interval != 'custom_days'">{{ order.plan.interval }}</small>
                                        <small v-else>{{ order.plan.custom_interval_days }} {{ __('Days') }}</small>
                                    </td>
                                    <td class="d-flex">
                                        <Link :href="route('company.orders.show',order.id)" v-tooltip="__('Order Details')" class="btn btn-sm pl-0">
                                            <EyeIcon/>
                                        </Link>
                                        <a :href="route('orders.pdf.download', order.id)" v-tooltip="__('Download')" target="_blank" class="btn btn-sm pl-0 text-secondary">
                                            <i class="fa-solid fa-download fa-2x"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h6>{{ __('No Data Found') }}</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination  -->
                    <Pagination :links="orders.links" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Feature from "../../Shared/Admin/Plan/Feature.vue";
import Pagination from "../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";
import ArrowRight from "../../Shared/Icons/ArrowRight.vue";

export default {
    components: {
        Feature,
        Pagination,
        Inertia,
        ArrowRight,
    },
    props: {
        plans: {
            type: Array,
            required: true,
        },
        currently_subscribed: {
            type: Object,
            required: true,
        },
        orders: Array,
        filters: Object || Array,
    },
    data() {
        return {
            subscription: this.$page.props.current_subscription,
            showFilter: false,
            form: {
                order_id: "",
                payment_method: "",
                amount: "",
                currency_symbol: "",
                plan: {},
            },
            filterForm: {
                search: this.filters.search,
                payment: this.filters.payment,
                plan: this.filters.plan,
            },
        };
    },
    methods:{
        getPlanDetails(planId){

        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("companyOrder", this.showFilter);
        },
        filterData() {
            Inertia.get(
                route("company.billing"),
                {
                    company: this.filterForm.company,
                    search: this.filterForm.search,
                    payment: this.filterForm.payment,
                    plan: this.filterForm.plan,
                },
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                }
            );
        },

    },
    watch: {
        "filterForm.search": debounce((value) => {
            Inertia.get(
                route("company.billing"),
                { search: value },
                {
                    preserveState: true,
                    preserveScroll: true,
                    replace: true,
                }
            );
        }, 500),
    },
    mounted() {
        this.checkPagePermission("owner");
        this.showFilter = localStorage.getItem("companyOrder") == "true" ? true : false;
    },
};
</script>

<style scoped>


.billing .card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.billing .card .card-header {
    font-weight: 500;
}
.billing .card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.billing .card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}


.billing .border-start-primary {
    border-left-color: #0061f2 !important;
}
.billing .border-start-secondary {
    border-left-color: #6900c7 !important;
}
.billing .border-start-success {
    border-left-color: #00ac69 !important;
}
.billing .border-start-lg {
    border-left-width: 0.25rem !important;
}
.billing .h-100 {
    height: 100% !important;
}
</style>
