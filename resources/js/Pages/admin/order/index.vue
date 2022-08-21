<template>
    <Head :title="__('Order List')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Order List') }}</h3>
                        <div>
                            <button class="btn btn-secondary ml-2" @click="filteringData">
                                <i class="fa-solid fa-filter"></i>
                                &nbsp;
                                <span v-if="!showFilter">{{ __('Show Filter') }}</span>
                                <span v-else>{{ __('Hide Filter') }}</span>
                            </button>
                            <Link v-if="filterForm.company || filterForm.search || filterForm.payment || filterForm.plan" :href="route('orders.index')" class="btn btn-danger ml-2">
                                <i class="fa-solid fa-times"></i>
                                {{ __('Clear') }}
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom row" v-if="showFilter">
                <div class="col-3">
                    <label>{{ __('Search') }}</label>
                    <input @keyup="searchData" v-model="filterForm.search" type="text" placeholder="Search order id, transaction id" class="form-control">
                </div>
                <div class="col-3">
                    <label>{{ __('Company') }}</label>
                   <select class="form-control" v-model="filterForm.company" @change="filterData">
                        <option value="">{{ __('All') }}</option>
                        <option :value="company.id" v-for="company in companies" :key="company.id">
                            {{ company.name }}
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Plan</label>
                    <select v-model="filterForm.plan" class="form-control" @change="filterData">
                        <option value="">{{ __('All') }}</option>
                        <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Payment</label>
                    <select class="form-control" v-model="filterForm.payment" @change="filterData">
                        <option value="">{{ __('All') }}</option>
                        <option value="paypal">Paypal</option>
                        <option value="stripe">Stripe</option>
                        <option value="flutterwave">Flutterwave</option>
                        <option value="mollie">Mollie</option>
                        <option value="midtrans">Midtrans</option>
                        <option value="paystack">Paystack</option>
                        <option value="razorpay">Razorpay</option>
                        <option value="instamojo">Instamojo</option>
                    </select>
                </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Company') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="orders && orders.data.length">
                                <tr v-for="(order,index) in orders.data" :key="index">
                                    <td>#<span v-html="order.order_id"></span></td>
                                    <td><span v-html="order.transaction_id"></span></td>
                                    <td>
                                        <b>{{ order.company_name }} ({{ order.company_email }})</b>
                                    </td>
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
                                        <button @click="showDetails(order)" v-tooltip="__('Order Details')" class="btn btn-sm pl-0">
                                            <EyeIcon/>
                                        </button>
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

     <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Order Details') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="40%">{{ __('Order ID') }}</td>
                                            <td width="70%">
                                                #<span v-html="form.order_id"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Transaction ID') }}</td>
                                            <td width="70%">
                                                <span v-html="form.transaction_id"></span>
                                            </td>
                                        </tr>
                                         <tr v-if="form.company && form.company.user">
                                            <td width="40%">{{ __('Company') }}</td>
                                            <td width="60%">
                                                <b>{{ form.company.user.name }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Payment Method') }}</td>
                                            <td width="60%" class="text-capitalize">
                                                {{ form.payment_method }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Amount') }}</td>
                                            <td width="60%">
                                               {{ form.currency_symbol }}&nbsp;{{ form.amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Plan Name') }}</td>
                                            <td width="60%">
                                              {{ form.plan.name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Plan Type') }}</td>
                                            <td width="60%" class="text-capitalize">
                                              {{ form.plan.type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Subscription Type') }}</td>
                                            <td width="60%" class="text-capitalize">
                                              {{ form.plan.interval }}
                                            </td>
                                        </tr>
                                        <tr v-if="form.plan.interval == 'custom_days'">
                                            <td width="40%">{{ __('Custom Days') }}</td>
                                            <td width="60%">
                                              {{ form.plan.custom_interval_days }} {{ __('Days') }}
                                            </td>
                                        </tr>
                                        <tr v-if="form.plan.plan_features">
                                            <td width="40%">{{ __('Plan Features') }}</td>
                                            <td width="60%">
                                               <Feature name="Unlimited Employees" :checked="!form.plan.plan_features.is_limited_employee"/>
                                                <Feature name="Max Employees" :checked="true" :value="form.plan.plan_features.is_limited_employee ? form.plan.plan_features.max_employees : '∞'"/>
                                                <Feature name="Max Teams" :checked="true" :value="form.plan.plan_features.max_teams"/>
                                                <Feature name="Max Leave Types" :checked="true" :value="form.plan.plan_features.max_leave_types"/>
                                                <Feature name="Custom Theme Look" :checked="form.plan.plan_features.custom_theme_look"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import Feature from "../../../Shared/Admin/Plan/Feature.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        companies: Array,
        plans: Array,
        orders: Array,
        filters: Object || Array,
    },
    components: {
        Pagination,
        Feature,
        Inertia,
    },
    data() {
        return {
            showFilter: false,
            showModal: false,

            form: {
                order_id: "",
                payment_method: "",
                amount: "",
                currency_symbol: "",
                plan: {},
            },

            filterForm: {
                company: this.filters.company,
                search: this.filters.search,
                payment: this.filters.payment,
                plan: this.filters.plan,
            },
        };
    },
    methods: {
        showDetails(order) {
            this.form.order_id = order.order_id;
            this.form.transaction_id = order.transaction_id;
            this.form.payment_method = order.payment_provider;
            this.form.amount = order.amount;
            this.form.currency_symbol = order.currency_symbol;
            this.form.plan = order.plan;
            this.form.company = order.company;
            this.showModal = true;
        },
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminOrder", this.showFilter);
        },
        filterData() {
            console.log(this.filterForm);
            Inertia.get(
                route("orders.index"),
                {
                    company: this.filterForm.company,
                    search: this.filterForm.search,
                    payment: this.filterForm.payment,
                    plan: this.filterForm.plan,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        },
    },
    watch: {
        "filterForm.search": debounce((value) => {
            Inertia.get(
                route("orders.index"),
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),
    },
    mounted() {
        this.checkPagePermission("admin");
        this.showFilter =
            localStorage.getItem("adminOrder") == "true" ? true : false;
    },
};
</script>

<style scoped>
.modal-content {
    width: 750px !important;
}
</style>
