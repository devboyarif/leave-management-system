<template>

    <Head :title="__('Company Holidays')" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>{{ __('Official Holiday List') }}</span>

                        <div v-click-outside="()=> showHolidayDropdown = false">
                            <div class="btn-group" :class="{'show':showHolidayDropdown}" role="group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" @click="showHolidayDropdown = !showHolidayDropdown">
                                    {{ __('Options') }}
                                </button>
                                <div class="dropdown-menu employee-add-dropdown" :class="{'show':showHolidayDropdown}" x-placement="bottom-start">
                                    <a @click="showCalendarModal = true" class="dropdown-item" href="javascript:void(0)" v-tooltip="'Calendar View'">
                                        <i class="fa-regular fa-calendar"></i>
                                    {{ __('Calendar View') }}
                                    </a>
                                <Link :href="route('company.request.holidays')" @click="showEmployeeCreateModal = true" class="dropdown-item" v-tooltip="'Show all requested holidays'">
                                        <i class="fa-solid fa-eye"></i>
                                    {{ __('Requested Holidays') }}
                                    </Link>
                                    <a @click="deleteHolidays" class="dropdown-item" href="javascript:void(0)" v-tooltip="'Remove all holidays'">
                                        <i class="fa-solid fa-times"></i>
                                        {{ __('Delete All Holidays') }}
                                    </a>
                                    <a @click="showImportHolidayModal" class="dropdown-item" href="javascript:void(0)" v-tooltip="'Remove all holidays'">
                                        <i class="fa-solid fa-plus"></i>
                                        {{ __('Import Holidays') }}
                                    </a>
                                </div>
                            </div>
                            <button @click="showModal = true" class="btn btn-primary ml-2">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Add Holiday') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 v-if="holidays.length">{{ __('Total Holidays') }} - {{ holidays.length }}</h5>
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
                                <div>
                                    <button @click="editData(holiday)" v-tooltip="'Edit Holiday'" class="btn btn-sm  pl-0">
                                        <EditIcon />
                                    </button>
                                    <button @click="deleteData(holiday.id)" v-tooltip="'Delete Holiday'" class="btn btn-sm">
                                        <DeleteIcon />
                                    </button>
                                </div>
                            </div>
                        </template>
                        <div v-else class="col-12 text-center">
                            <h5 class="text-center">{{ __('No Data Found') }}</h5>
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
                                    <span v-if="!editMode">{{ __('Create Official Holiday') }}</span>
                                    <span v-else>{{ __('Edit Official Holiday') }}</span>
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
                                                @update:modelValue="handleStartDate"
                                                :class="{'is-invalid':form.errors.start}" />
                                            <ErrorMessage :name="form.errors.start" />
                                        </div>
                                        <div class="col-md-6">
                                            <Label :name="__('End Date')" />
                                            <Datepicker v-model="form.end" :enableTimePicker="false"
                                                @update:modelValue="handleEndDate"
                                                :class="{'is-invalid':form.errors.end}" />
                                            <ErrorMessage :name="form.errors.end" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="showModal = false">{{ __('Close') }}</button>
                                    <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                        <Loading v-if="form.processing" />
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
                        <div class="modal-content"  v-click-outside="()=> showCalendarModal = false">
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

    <!-- Import holidays -->
    <div v-if="importHolidayModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <span>{{ __('Import Holidays from country') }}</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="importHolidayModal = false">&times;</span>
                                </button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            <Label :name="__('Country')" />
                                            <select v-model="importForm.country" id="" class="form-control" :class="{'is-invalid':importForm.errors.country}">
                                                <option value="" class="d-none">{{ __('Select Country') }}</option>
                                                <option :value="country.id" v-for="country in countries" :key="country.id">
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                            <ErrorMessage :name="importForm.errors.country" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <template v-if="!importForm.processing">
                                        <button @click="importHolidays('add')" type="button" class="btn btn-primary">
                                            <Loading v-if="importForm.processing" />
                                            <span v-else>
                                                <i class="fa-solid fa-check mr-1"></i>
                                                {{ __('Import Holidays') }}
                                            </span>
                                        </button>
                                        <button @click="importHolidays('add_delete')" type="button" class="btn btn-danger">
                                            <Loading v-if="importForm.processing" />
                                            <span v-else>
                                                <i class="fa-solid fa-check mr-1"></i>
                                                {{ __('Import & Delete Current Holidays') }}
                                            </span>
                                        </button>
                                    </template>
                                    <button type="button" class="btn btn-primary" v-else>
                                        <Loading />
                                    </button>
                                </div>
                            </form>
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
            }),

            importForm: this.$inertia.form({
                country: "",
                type: "add",
            }),

            editMode: false,
            showModal: false,
            showCalendarModal: false,
            importHolidayModal: false,
            holiday_id: null,
            showHolidayDropdown: false,
            countries: [],
        };
    },
    methods: {
        saveData() {
            if (!this.editMode) {
                this.form.post(
                    route("company.holidays.store"),
                    {
                        onSuccess: () => {
                            this.showModal = true;
                            this.form.reset();
                        },
                    },
                    {
                        preserveScroll: true,
                        preserveState: true,
                    }
                );
            } else {
                this.form.put(
                    route("company.holidays.update", this.holiday_id),
                    {
                        onSuccess: () => {
                            this.showModal = false;
                            this.form.reset();
                        },
                    },
                    {
                        preserveScroll: false,
                        preserveState: true,
                    }
                );
            }
        },
        editData(holiday) {
            this.form.clearErrors();
            this.editMode = true;
            this.form.reset();
            this.form.company_id = this.company.id;
            this.holiday_id = holiday.id;
            this.form.title = holiday.title;
            this.form.start = holiday.start;
            this.form.end = holiday.end;
            this.showModal = true;
        },
        deleteData(holiday_id) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.form.delete(
                        route("company.holidays.destroy", holiday_id)
                    );
                }
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
                let dateCheck = this.checkDateValidity(this.form.start, formatTime,true);

                if(!dateCheck){
                    this.form.end = ''
                    return this.toastError("End date must be grater than start date")
                }
            }

            this.form.end = formatTime;
        },
        deleteHolidays() {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route("company.holidays.all.destroy"));
                }
            });
        },
        async showImportHolidayModal() {
            if (!this.countries.length) {
                let response = await axios.get(route("all.countries"));
                this.countries = response.data;
            }

            this.importHolidayModal = true;
        },
        importHolidays(type) {
            this.importForm.type = type;

            this.importForm.post(
                route("company.holidays.import"),
                {
                    onSuccess: () => {
                        this.importHolidayModal = false;
                        this.importForm.reset();
                    },
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                }
            );
        },
    },
    mounted() {
        this.checkPagePermission("owner");
    },
};
</script>
