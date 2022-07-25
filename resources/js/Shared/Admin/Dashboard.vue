<template>
    <Head :title="__('Dashboard')"/>
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-money-bill-1"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Income') }}</span>
                    <span class="info-box-number">
                        <b>{{ summary.currency_symbol }}</b>
                        {{ summary.total_income }}
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
                <div class="card-body">
                    <YearlyEarningChart :data="yearly_earnings"/>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">{{ __('Recent Registered Companies') }}</h3>
                          <div class="card-tools">
                                 <Link :href="route('companies.index')" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    {{ __('View All') }}
                                </Link>
                            </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Country') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="company in recent_companies" :key="company.id">
                                    <td>
                                        <img :src="company.avatar" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        {{ company.name }}
                                    </td>
                                    <td>{{ company.email }}</td>
                                    <td>
                                        {{ company.country }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">{{ __('Recent Orders') }}</h3>
                            <div class="card-tools">
                                 <Link :href="route('orders.index')" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    {{ __('View All') }}
                                </Link>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
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
                                    <tr v-for="order in recent_orders" :key="order.id">
                                        <td>
                                           #{{ order.id }}
                                        </td>
                                        <td>{{ order.company_name }}</td>
                                        <td>{{ order.plan }}</td>
                                        <td>{{ order.amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Expenses per Company (Most expenses companies)') }}</h3>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <CompaniesExpenseChart :data="expense_per_company"/>
                </div>
                <div class="card-body" v-if="expense_per_company && expense_per_company.companies_amount">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="data in expense_per_company.companies_amount" :key="data.id" >
                             {{ data.name }}
                            <span class="badge badge-primary badge-pill">
                               {{ summary.currency_symbol }} {{ data.amount }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Companies per Country (Most active countries)') }}</h3>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <CountriesCompanyChart :data="companies_per_country"/>
                </div>
                <div class="card-body" v-if="companies_per_country && companies_per_country.companies_per_country">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="data in companies_per_country.companies_per_country" :key="data.id" >
                             {{ data.name }}
                            <span class="badge badge-primary badge-pill">{{ data.companies_count }} {{ __('Companies') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
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
                currency_symbol: '$',
            },

            // Chart
            expense_per_company: {},
            companies_per_country: {},
            yearly_earnings: {},

            // Table
            recent_companies: [],
            recent_orders : [],
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
        // console.log(response.data.companies_per_country)
    },
};
</script>
