
<template>
  <FullCalendar :options="calendarOptions"/>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    props: {
        events: Array,
    },
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: this.events,
            },
        };
    },
};
</script>
