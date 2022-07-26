<template>
    <div class="card-body" v-if="!loading">
        <apexchart type="bar" height="350" :options="chartOptions" :series="series"/>
    </div>
    <div class="card-body mx-auto" v-else>
        <Loading :messageShow="false" size="fa-2x" />
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
            series: [
                {
                    name: "Income",
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
                },
            ],
            chartOptions: {
                chart: {
                    type: "bar",
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: [
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                    ],
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val ;
                        },
                    },
                },
            },
        };
    },
    watch: {
        data: {
            handler() {
                this.series[0].data = this.data.amount;
                this.chartOptions.xaxis.categories = this.data.months;
                this.loading = false;
            },
            deep: true,
        },
    }
};
</script>
