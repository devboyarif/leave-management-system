<template>

    <Head :title="__('Company Holidays')" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>{{ __('Official Holiday List') }}</span>
                        <div>
                            <button @click="showCalendarModal = true" class="btn btn-info" type="button">
                               <i class="fa-regular fa-calendar"></i>
                                {{ __('Calendar View') }}
                            </button>
                            <button @click="showModal = true" class="btn btn-primary ml-1" type="button">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Create Holiday Request') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <template v-if="holidays && holidays.length">
                            <div v-for="holiday in holidays" :key="holiday.id"
                                class="col-12 col-md-6 holidayCont officalHCont d-flex justify-content-between align-items-center main-user-fields">
                                <div class="mt-4">
                                    <h6><strong>{{ holiday.title }}</strong>
                                        <span class="text-danger ml-1">
                                            {{ holiday.days }} {{ pluralize(holiday.days, 'Day') }}
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
                            </div>
                        </template>
                        <div v-else class="col-12 text-center">
                            <h6 class="text-center">{{ __('No Data Found') }}</h6>
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
                                    <span>{{ __('Holiday Request Create') }}</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent="saveData">
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label :name="__('Title')" />
                                            <input v-model="form.title" type="text" class="form-control"
                                                :class="{'is-invalid':form.errors.title}" id="name">
                                            <ErrorMessage :name="form.errors.title" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <Label :name="__('Start Date')" />
                                            <Datepicker v-model="form.start" :enableTimePicker="false"
                                                @update:modelValue="handleStartDate" :class="{'is-invalid':form.errors.start}"/>
                                            <ErrorMessage :name="form.errors.start"/>
                                        </div>
                                        <div class="col-md-6">
                                            <Label :name="__('End Date')" />
                                            <Datepicker v-model="form.end" :enableTimePicker="false"
                                                @update:modelValue="handleEndDate" :class="{'is-invalid':form.errors.end}"/>
                                            <ErrorMessage :name="form.errors.end"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-12">
                                            <Label :name="__('Note')"/>
                                            <textarea v-model="form.note" rows="5" class="form-control"
                                                :class="{'is-invalid':form.errors.note}">
                                            </textarea>
                                            <ErrorMessage :name="form.errors.note"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="showModal = false">{{ __('Close') }}</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing"/>
                                        <span v-else>
                                            <i class="fa-solid fa-check mr-1"></i>
                                            {{ __('Save') }}
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
                        <div class="modal-content" v-click-outside="()=> showCalendarModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Official Holiday Calendar') }}
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
                note: "",
            }),

            showModal: false,
            showCalendarModal: false,
            holiday_id: null,
        };
    },
    methods: {
        saveData() {
            this.form.post(route("employee.holiday.request.create"), {
                onSuccess: () => {
                    this.showModal = false;
                    this.form.reset();
                },
            });
        },
        handleStartDate(startDate) {
            const formatTime = dayjs(startDate).format("YYYY-MM-DD");

            if(this.form.end){
                let dateCheck = this.checkDateValidity(formatTime, this.form.end, true);

                if(!dateCheck){
                    this.form.end = ''
                    return this.toastError("End date must be grater than start date")
                }
            }

            this.form.start = formatTime;
        },
        handleEndDate(endDate) {
            const formatTime = dayjs(endDate).format("YYYY-MM-DD");

            if(this.form.start){
                let dateCheck = this.checkDateValidity(this.form.start, formatTime, true);

                if(!dateCheck){
                    this.form.end = ''
                    return this.toastError("End date must be grater than start date")
                }
            }

            this.form.end = formatTime;
        }
    },
    mounted(){
        this.checkPagePermission('employee')
    }
};
</script>
