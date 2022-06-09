<template>

    <Head title="Company List" />

    <div class="row justify-content-center">
        <div class="col-md-4 mt-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="text-center">
                        <h3>{{ user.name }}</h3>
                        <h5>Country : {{ company.country.name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Holiday Request List</span>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Request For</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="holidays && holidays.data.length">
                                <tr v-for="(holiday,index) in holidays.data" :key="index">
                                    <!-- {{ holiday }} -->
                                    <td v-if="holiday.employee.user">
                                        <img :src="holiday.employee.user.avatar" alt="Product 1"
                                            class="img-circle img-size-32 mr-2">
                                        {{ holiday.employee.user.name }}
                                    </td>
                                    <td v-if="holiday.start && holiday.end">
                                        {{ requestFor(holiday.start, holiday.end) }}
                                        (<span class="text-danger ml-1">
                                            {{ holiday.days }} Days
                                        </span>)
                                    </td>
                                    <td>
                                        <button v-tooltip="'Details holiday'" @click="showDetails(holiday)"
                                            class="btn btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                            Show Holidays
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h3>No User Found</h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination  -->
                    <Pagination :links="holidays.links" />
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
                                    Holiday Details
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- {{ form }} -->
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Employee Name</td>
                                            <td>{{ form.employee_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ form.employee_email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Holiday Title</td>
                                            <td>{{ form.title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ requestFor(form.start, form.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Days</td>
                                            <td>{{  form.days }} Days</td>
                                        </tr>
                                        <tr>
                                            <td>Background Color</td>
                                            <td>
                                                <span :style="{ background: form.color, border: '2px solid '+form.color }" class="leave-type-color">
                                                   {{ form.color }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Note</td>
                                            <td>{{ form.note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import debounce from "lodash/debounce";
import { Inertia } from "@inertiajs/inertia";
import dayjs from "dayjs";

export default {
    props: {
        holidays: Array,
        company: Object,
        user: Object,
    },
    components: {
        Inertia,
        Pagination,
    },
    data() {
        return {
            showModal: true,
            form: {
                employee_name: "",
                employee_email: "",
                title: "",
                start: "",
                end: "",
                days: "",
                color: "#ff0000",
                note: "",
            },
        };
    },
    methods: {
        requestFor(startDate, endDate) {
            const start = dayjs(startDate).format("DD MMM, YYYY");
            const end = dayjs(endDate).format("DD MMM, YYYY");

            return `${start} - ${end}`;
        },
        showDetails(holiday) {
            this.form.employee_name = holiday.employee.user.name;
            this.form.employee_email = holiday.employee.user.email;
            this.form.days = holiday.days;
            this.form.title = holiday.title;
            this.form.start = holiday.start;
            this.form.end = holiday.end;
            this.form.color = holiday.color;
            this.form.note = holiday.note;

            this.showModal = true;
        },
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
