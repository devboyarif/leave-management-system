<template>

    <Head :title="__('Holiday Request List')" />

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Holiday Request List') }}</h3>
                         <Link :href="route('company.holidays.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                            {{ __('Back') }}
                        </Link>
                    </div>


                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Holiday Title') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="holidays && holidays.data.length">
                                <tr v-for="(holiday,index) in holidays.data" :key="index">
                                    <td v-if="holiday.employee.user">
                                        <img :src="holiday.employee.user.avatar" alt="img"
                                            class="img-circle img-size-32 mr-2">
                                        <Link :href="route('company.employees.show',holiday.employee.user_id)">{{ holiday.employee.user.name }}</Link>
                                    </td>
                                    <td >
                                        {{ holiday.title }}
                                    </td>
                                    <td v-if="holiday.start && holiday.end">
                                        {{ requestFor(holiday.start, holiday.end) }}
                                        (<span class="text-danger ml-1">
                                            {{ holiday.days }} {{ pluralize(holiday.days, __('Day')) }}
                                        </span>)

                                        {{ holiday.days }} {{ pluralize(holiday.days, __('Day')) }}
                                    </td>
                                    <td>
                                        <button @click="showDetails(holiday)" v-tooltip="__('View holiday details')" class="btn btn-sm  pl-0">
                                            <EyeIcon/>
                                        </button>
                                        <button @click="acceptRequest(holiday.id)" v-tooltip="__('Accept and add to official holiday list')" class="btn btn-sm  pl-0">
                                            <CheckIcon/>
                                        </button>
                                        <button @click="rejectRequest(holiday.id)" v-tooltip="__('Reject and delete from holiday request list')" class="btn btn-sm  pl-0">
                                            <CrossIcon/>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h6>{{ __('No Data Found') }}</h6>
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


    <!-- Holiday Details Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog d-flex justify-content-center" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Request Holiday Details') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">{{ __('Employee Name') }}</td>
                                            <td width="70%">{{ form.employee_name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Email') }}</td>
                                            <td width="70%">{{ form.employee_email }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Holiday Title') }}</td>
                                            <td width="70%">{{ form.title }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Date') }}</td>
                                            <td width="70%">{{ requestFor(form.start, form.end) }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Total Days') }}</td>
                                            <td width="70%">{{ form.days }} {{ pluralize(form.days, 'Day') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Note') }}</td>
                                            <td width="50%">{{ form.note }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">{{ __('Close') }}</button>
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
import dayjs from "dayjs";

export default {
    props: {
        holidays: Array,
        company: Object,
        user: Object,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            showModal: false,
            form: {
                employee_name: "",
                employee_email: "",
                title: "",
                start: "",
                end: "",
                days: "",
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
            this.form.note = holiday.note;

            this.showModal = true;
        },
        acceptRequest(id) {
            this.$inertia.post(route("company.request.holidays.accept"), {
                id,
            });
        },
        rejectRequest(id) {
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
                    this.$inertia.delete(
                        route("company.request.holidays.reject", id)
                    );
                }
            });
        },
    },
     mounted(){
        this.checkPagePermission('owner')
    }
};
</script>

<style scoped>
.modal-dialog {
    max-width: 1000px !important;
}
</style>
