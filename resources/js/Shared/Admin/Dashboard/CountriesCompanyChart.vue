<template>
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">{{ __('Companies per Country (Most active countries)') }}</h3>
        </div>
        <template v-if="!loading">
            <div class="card-body d-flex justify-content-center">
                <apexchart type="pie" width="380" :options="chartOptions" :series="series"/>
            </div>
            <div class="card-body" v-if="companies_per_country && companies_per_country.length">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center" v-for="data in companies_per_country" :key="data.id" >
                            {{ data.name }}
                        <span class="badge badge-primary badge-pill">{{ data.companies_count }} {{ __('Companies') }}</span>
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
            companies_per_country: [],
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
                this.companies_per_country = this.data.companies_per_country;
                this.series = this.data.percentage;
                for (let i = 0; i < this.data.countries.length; i++) {
                    this.chartOptions.labels.push(this.data.countries[i]);
                }
                this.loading = false;
            },
            deep: true,
        },
    }
};
</script>
