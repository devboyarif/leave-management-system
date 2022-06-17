<template>
    <apexchart type="donut" :options="chartOptions" :series="series"></apexchart>
</template>


<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    props: {
        series: {
            type: Array,
            default: [50, 50],
        },
        title: {
            type: String,
            default: "Title",
        },
        labels: {
            type: Array,
            default: ["Used", "Remaining"],
        },
        colors: {
            type: Array,
            default: ["#3498db", "#e74c3c"],
            // default: ["#2A8737", "#F23D4E"],
        },
        width: {
            type: Number,
            default: 300,
        },
    },
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return {
            series: this.series,
            chartOptions: {
                chart: {
                    width: this.width,
                    type: "pie",
                },
                colors: this.colors,
                labels: this.labels,
                title: {
                    text: this.title,
                    align: "left",
                    style: {
                        fontSize: "18px",
                        fontWeight: "bold",
                        fontFamily: undefined,
                        color: "#263238",
                    },
                },
            },
        };
    },
};
</script>
