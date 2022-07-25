<template>
    <apexchart type="pie" width="380" :options="chartOptions" :series="series"/>
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
                this.series = this.data.amounts;
                for (let i = 0; i < this.data.amounts.length; i++) {
                    this.chartOptions.labels.push(this.data.companies[i]);
                }
            },
            deep: true,
        },
    }
};
</script>
