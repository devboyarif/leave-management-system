<template>

    <Head title="Company Holidays" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Official Holiday List</span>
                        <div>
                            <button @click="showCalendarModal = true" class="btn btn-info" type="button">
                               <i class="fa-regular fa-calendar"></i>
                                Show Calendar
                            </button>
                            <button @click="showModal = true" class="btn btn-primary ml-1" type="button">
                                <i class="fa-solid fa-plus"></i>
                                Add Holiday
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <div v-for="holiday in holidays" :key="holiday.id"
                            class="col-12 col-md-6 holidayCont officalHCont d-flex justify-content-between align-items-center main-user-fields">
                            <div class="mt-4">
                                <h6><strong>{{ holiday.title }}</strong>
                                    <span class="text-danger ml-1">
                                        {{ holiday.days }} Days
                                    </span>
                                </h6>
                                <h6 class="d-flex align-items-center">
                                    <span class="m-widget4__sub">
                                        <span class="m-widget4__sm-text mr-1">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ holiday.format_start_date }}
                                        </span>

                                        <span class="m-widget4__sm-text ml-1">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ holiday.format_end_date }}
                                        </span>
                                    </span>
                                </h6>
                            </div>
                            <div>
                                <!-- <button @click="editData(holiday)" class="btn btn-primary btn-sm ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button @click="deleteData(holiday.id)" class="btn btn-danger btn-sm mx-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button> -->

                                 <button @click="editData(holiday)" v-tooltip="'Edit Holiday'" class="btn btn-sm  pl-0">
                                    <EditIcon/>
                                </button>
                                 <button @click="deleteData(holiday.id)" v-tooltip="'Delete Holiday'" class="btn btn-sm">
                                    <DeleteIcon/>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create or Edit Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <span v-if="!editMode">Create Official Holiday</span>
                                    <span v-else>Edit Official Holiday</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label name="Title" />
                                            <input v-model="form.title" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.title}" id="name">
                                            <ErrorMessage :name="form.errors.title" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <Label name="Start Date" />
                                            <Datepicker v-model="form.start" :enableTimePicker="false"
                                                @update:modelValue="handleStartDate" :class="{'is-invalid':form.errors.start}"/>
                                            <ErrorMessage :name="form.errors.start"/>
                                        </div>
                                        <div class="col-md-6">
                                            <Label name="End Date" />
                                            <Datepicker v-model="form.end" :enableTimePicker="false"
                                                @update:modelValue="handleEndDate" :class="{'is-invalid':form.errors.end}"/>
                                            <ErrorMessage :name="form.errors.end"/>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label name="Holiday Color" :required="false" />
                                            <input v-model="form.color" type="color" class="form-control"
                                                :class="{'is-invalid':form.errors.color}" id="name">
                                            <ErrorMessage :name="form.errors.color"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="showModal = false">Close</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                         <Loading v-if="form.processing"/>
                                        <span v-else>
                                            <i class="fa-solid fa-check mr-1"></i>
                                            Save
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>

    <!-- Holiday Calendar Modal  -->
    <div v-if="showCalendarModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Official Holiday Calendar
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showCalendarModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <FullCalendar :options="calendarOptions" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import dayjs from "dayjs";

export default {
    props: {
        user: Object,
        company: Object,
        holidays: Array,
    },
    components: {
        Datepicker,
        FullCalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: this.holidays,
            },

            form: this.$inertia.form({
                company_id: this.company.id,
                title: "",
                start: "",
                end: "",
                color: "#ff0000",
            }),

            editMode: false,
            showModal: false,
            showCalendarModal: false,
            holiday_id: null,
        };
    },
    methods: {
        saveData() {
            if (!this.editMode) {
                this.form.post(route("holidays.store"), {
                    onSuccess: () => {
                        this.showModal = false;
                        this.form.reset();
                        // this.$toast.success("Holiday Created Successfully");
                    },
                });
            } else {
                this.form.put(route("holidays.update", this.holiday_id), {
                    onSuccess: () => {
                        this.showModal = false;
                        this.form.reset();
                        // this.$toast.success("Holiday Created Successfully");
                    },
                });
            }
        },
        editData(holiday) {
            this.editMode = true;
            this.form.reset();
            this.form.company_id = this.company.id;
            this.holiday_id = holiday.id;
            this.form.title = holiday.title;
            this.form.start = holiday.start;
            this.form.end = holiday.end;
            this.form.color = holiday.color;
            this.showModal = true;
            console.log(holiday);
        },
        deleteData(holiday_id) {
            if (confirm("Are you sure to delete?")) {
                this.form.delete(route("holidays.destroy", holiday_id));
            }
        },
        handleStartDate(startDate) {
            const formatTime = dayjs(startDate).format("YYYY-MM-DD");
            this.form.start = formatTime;
        },
        handleEndDate(endDate) {
            const formatTime = dayjs(endDate).format("YYYY-MM-DD");
            this.form.end = formatTime;
        },
    },
    mounted() {
        console.log(dayjs().format("YYYY-MM-DD"));
    },
};
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
</style>
