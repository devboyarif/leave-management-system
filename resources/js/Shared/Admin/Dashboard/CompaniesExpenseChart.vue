<template>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">{{ __('Expenses per Company (Most expenses companies)') }}</h3>
        </div>

        <template v-if="!loading">
            <div class="card-body d-flex justify-content-center">
                <apexchart type="pie" width="380" :options="chartOptions" :series="series"/>
            </div>
            <div class="card-body" v-if="companies_amount && companies_amount.length">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center" v-for="data in companies_amount" :key="data.id" >
                        <Link :href="route('companies.show',data.user_id)">
                            {{ data.name }}
                        </Link>
                        <span class="badge badge-primary badge-pill">
                             {{ currencyPosition(data.amount) }}
                        </span>
                    </li>
                </ul>
            </div>
        </template>
        <div class="card-body mx-auto" v-else>
            <Loading :messageShow="false" size="fa-2x" />
        </div>
    </div>
</template>


<script>
import VueApexCharts from "vue3-apexcharts";
export default {
    components: {
        apexchart: VueApexCharts,
    },
    props:{
        data: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            loading: true,
            companies_amount: [],
            series: [1, 0, 0, 0, 0],
            chartOptions: {
                chart: {
                    width: 380,
                    type: "pie",
                },
                labels: [],
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    },
                ],
            },
        };
    },
    watch: {
        data: {
            handler() {
                this.companies_amount = this.data.companies_amount;
                this.series = this.data.amounts;
                for (let i = 0; i < this.data.amounts.length; i++) {
                    this.chartOptions.labels.push(this.data.companies[i]);
                }
                this.loading = false;
            },
            deep: true,
        },
    }
};
</script>
