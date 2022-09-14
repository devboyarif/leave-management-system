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
                            {{ company.company_name }}
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <label>{{ __('Plan') }}</label>
                    <select v-model="filterForm.plan" class="form-control" @change="filterData">
                        <option value="">{{ __('All') }}</option>
                        <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                </div>
                <div class="col-3">
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
                                    <td>
                                        <Link :href="route('orders.show',order.id)" v-tooltip="__('Order Details')">
                                            #<span v-html="order.order_id"></span>
                                        </Link>
                                    </td>
                                    <td><span v-html="order.transaction_id"></span></td>
                                    <td>
                                        <b>
                                            <Link :href="route('companies.show',order.company_id)">
                                                {{ order.company_name }}
                                            </Link>
                                            ({{ order.company_email }})
                                        </b>
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
                                        <Link :href="route('orders.show',order.id)" v-tooltip="__('Order Details')" class="btn btn-sm pl-0">
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
        filteringData() {
            this.showFilter = !this.showFilter;
            localStorage.setItem("adminOrder", this.showFilter);
        },
        filterData() {
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
