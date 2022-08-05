<template>
    <Head :title="__('Contact Messages')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Contact Messages') }}</h3>
                </div>
                    <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="messages && messages.data.length">
                                <tr v-for="(message,index) in messages.data" :key="index">
                                    <td>{{ message.name }}</td>
                                        <td>
                                        {{ message.email }}
                                    </td>
                                        <td>
                                        {{ message.phone }}
                                    </td>
                                    <td class="d-flex">
                                        <button @click="showDetails(message)" v-tooltip="__('Details')" class="btn btn-sm">
                                            <EyeIcon/>
                                        </button>
                                        <button @click="deleteData(message.id)" v-tooltip="__('Delete')" class="btn btn-sm">
                                            <DeleteIcon/>
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
                    <Pagination :links="messages.links" />
                </div>
            </div>
        </div>
    </div>

    <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Contact Message Details') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">{{ __('Name') }}</td>
                                            <td width="70%">{{ form.name }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Email') }}</td>
                                            <td width="70%">{{ form.email }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Phone') }}</td>
                                            <td width="70%">{{ form.phone }}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Message') }}</td>
                                            <td width="70%">{{ form.message }}</td>
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

export default {
    props: {
        messages: Array,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            showModal: false,
            form: {
                name: null,
                email: null,
                phone: null,
                message: null,
            },
        };
    },
    methods: {
        deleteData(id) {
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
                    this.$inertia.delete(route("contact.messages.destroy", id));
                }
            });
        },
        showDetails(request) {
            this.form.name = request.name;
            this.form.email = request.email;
            this.form.phone = request.phone;
            this.form.message = request.message;
            this.showModal = true;
        },
    },
};
</script>
