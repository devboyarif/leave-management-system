<template>

    <Head :title="__('Dashboard')" />
    <div class="row pt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-money-bill-1"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Income') }}</span>
                    <span class="info-box-number">
                        {{ currencyPosition(summary.total_income) }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-building"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">{{ __('Total Companies') }}</span>
                    <span class="info-box-number">
                        {{ summary.total_companies }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Teams') }}</span>
                    <span class="info-box-number">
                        {{ summary.total_teams }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Employees') }}</span>
                    <span class="info-box-number">
                        {{ summary.total_employees }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Yearly Earning') }}</h3>
                </div>
                <YearlyEarningChart :data="yearly_earnings" />
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">{{ __('Recent Registered Companies') }}</h3>
                            <div class="card-tools" v-if="!loading">
                                <Link :href="route('companies.index')" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-arrow-left"></i>
                                {{ __('View All') }}
                                </Link>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="!loading">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>{{ __('Company') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Country') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="recent_companies && recent_companies.length">
                                        <tr v-for="company in recent_companies" :key="company.id">
                                            <td>
                                                <Link :href="route('companies.show',company.user_id)">
                                                    <img :src="company.avatar" alt="img"
                                                        class="img-circle img-size-32 mr-2">
                                                    {{ company.name }}
                                                </Link>
                                            </td>
                                            <td>{{ company.email }}</td>
                                            <td>
                                                {{ company.country }}
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
                        </div>
                        <div class="card-body mx-auto" v-else>
                            <Loading :messageShow="false" size="fa-2x" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">{{ __('Recent Orders') }}</h3>
                            <div class="card-tools" v-if="!loading">
                                <Link :href="route('orders.index')" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-arrow-left"></i>
                                {{ __('View All') }}
                                </Link>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" v-if="!loading">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>{{ __('Order ID') }}</th>
                                        <th>{{ __('Company') }}</th>
                                        <th>{{ __('Plan') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="recent_orders && recent_orders.length">
                                        <tr v-for="order in recent_orders" :key="order.id">
                                            <td>
                                                <Link :href="route('orders.show',order.id)" v-tooltip="__('Order Details')">
                                                    #{{ order.order_id }}
                                                </Link>
                                            </td>
                                            <td>
                                                 <Link :href="route('companies.show',order.company.id)">
                                                    {{ order.company.name }}
                                                </Link>
                                            </td>
                                            <td>{{ order.plan }}</td>
                                            <td>{{ order.amount }}</td>
                                        </tr>
                                    </template>
                                    <tr v-else>
                                        <td colspan="5" class="text-center">
                                            <h6>{{ __('No Data Found') }}</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body mx-auto" v-else>
                            <Loading :messageShow="false" size="fa-2x" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Expenses per companies  -->
            <CompaniesExpenseChart :data="expense_per_company" />

            <!-- Companies per countries  -->
            <CountriesCompanyChart :data="companies_per_country" />
        </div>
    </div>
</template>

<script>
    import Layout from "../Layout/Default.vue";
    import YearlyEarningChart from "./Dashboard/YearlyEarningChart.vue";
    import CompaniesExpenseChart from "./Dashboard/CompaniesExpenseChart.vue";
    import CountriesCompanyChart from "./Dashboard/CountriesCompanyChart.vue";

    export default {
        components: {
            Layout,
            YearlyEarningChart,
            CompaniesExpenseChart,
            CountriesCompanyChart,
        },
        data() {
            return {
                // Summary
                summary: {
                    total_income: 0,
                    total_companies: 0,
                    total_teams: 0,
                    total_employees: 0,
                },

                // Chart
                expense_per_company: {},
                companies_per_country: {},
                yearly_earnings: {},

                // Table
                recent_companies: [],
                recent_orders: [],

                loading: true,
            };
        },
        async mounted() {
            let response = await axios.get(route("admin.dashboard"));
            this.summary = response.data.summary;
            this.expense_per_company = response.data.expense_per_company;
            this.companies_per_country = response.data.companies_per_country;
            this.yearly_earnings = response.data.yearly_earnings;
            this.recent_companies = response.data.recent_companies;
            this.recent_orders = response.data.recent_orders;
            this.loading = false;
        },
    };
</script>
