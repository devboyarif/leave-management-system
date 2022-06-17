<template>
    <div class="d-flex justify-content-center">
        <apexchart height="400px" width="380px" type="donut" :options="chartOptions" :series="series"/>
    </div>
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
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%";
                    },
                },
                tooltip: {
                    enabled: false,
                },
            },
        };
    },
};
</script>

