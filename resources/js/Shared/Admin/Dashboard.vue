<template>
    <Head :title="__('Dashboard')"/>
        <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-primary"><i class="fa-regular fa-money-bill-1"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Income') }}</span>
                    <span class="info-box-number">$99999999</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-warning"><i class="fa-regular fa-building"></i></span>
                <div class="info-box-content">

                    <span class="info-box-text">{{ __('Total Companies') }}</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-people-group nav-icon"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Teams') }}</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-md">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Total Employees') }}</span>
                    <span class="info-box-number">1</span>
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
                    <YearlyEarningChart/>
                </div>
            </div>
            <!-- /.card -->

           <div class="row">
            <div class="col-lg-6">
                    <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">{{ __('Recent Registered Companies') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                        <small class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            12%
                                        </small>
                                        12,000 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td>
                                        <small class="text-warning mr-1">
                                            <i class="fas fa-arrow-down"></i>
                                            0.5%
                                        </small>
                                        123,234 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td>
                                        <small class="text-danger mr-1">
                                            <i class="fas fa-arrow-down"></i>
                                            3%
                                        </small>
                                        198 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        Perfect Item
                                        <span class="badge bg-danger">NEW</span>
                                    </td>
                                    <td>$199 USD</td>
                                    <td>
                                        <small class="text-success mr-1">
                                            <i class="fas fa-arrow-up"></i>
                                            63%
                                        </small>
                                        87 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-search"></i>
                                        </a>
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
                            <h3 class="card-title">Products</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Some Product
                                        </td>
                                        <td>$13 USD</td>
                                        <td>
                                            <small class="text-success mr-1">
                                                <i class="fas fa-arrow-up"></i>
                                                12%
                                            </small>
                                            12,000 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Another Product
                                        </td>
                                        <td>$29 USD</td>
                                        <td>
                                            <small class="text-warning mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                0.5%
                                            </small>
                                            123,234 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Amazing Product
                                        </td>
                                        <td>$1,230 USD</td>
                                        <td>
                                            <small class="text-danger mr-1">
                                                <i class="fas fa-arrow-down"></i>
                                                3%
                                            </small>
                                            198 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            Perfect Item
                                            <span class="badge bg-danger">NEW</span>
                                        </td>
                                        <td>$199 USD</td>
                                        <td>
                                            <small class="text-success mr-1">
                                                <i class="fas fa-arrow-up"></i>
                                                63%
                                            </small>
                                            87 Sold
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

           </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Expenses per Company (Most expenses companies)') }}</h3>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <CompaniesExpenseChart/>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Companies per Country (Most active countries)') }}</h3>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <CompaniesExpenseChart/>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
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
            // series: [80, 20],
            // chartOptions: {
            //     chart: {
            //         width: 380,
            //         type: "pie",
            //     },
            //     colors: ["#2A8737", "#F23D4E"],
            //     labels: ["Present", "Absent"],
            //     responsive: [
            //         {
            //             breakpoint: 480,
            //             options: {
            //                 chart: {
            //                     width: 200,
            //                 },
            //                 legend: {
            //                     position: "bottom",
            //                 },
            //             },
            //         },
            //     ],
            // },
        };
    },
    async mounted() {
        // let response = await axios.get(route("admin.dashboard"));
        // this.calendarOptions.events = response.data.events;
    },
};
</script>
