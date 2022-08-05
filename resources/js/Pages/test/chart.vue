<template>
   <apexchart type="donut" :options="chartOptions" :series="series"></apexchart>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return {
            series: [80, 20],
            chartOptions: {
                chart: {
                    width: 300,
                    type: "pie",
                },
                colors: ["#2A8737", "#F23D4E"],
                labels: ["Used", "Remaining"],
                title: {
                    text: "Casual",
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
