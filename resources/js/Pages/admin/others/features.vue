<template>

    <Head :title="__('Feature List')" />

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Feature List') }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th width="30%">{{ __('Title') }}</th>
                                <th width="60%">{{ __('Description') }}</th>
                                <th width="10%">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="features && features.data.length">
                                <tr v-for="(feature,index) in features.data" :key="index">
                                    <td>{{ feature.title }}</td>
                                    <td>{{ feature.description }}</td>
                                    <td class="d-flex">
                                        <button @click="editData(feature)" v-tooltip="__('Edit')"
                                            class="btn btn-sm pl-0">
                                            <EditIcon />
                                        </button>
                                        <button @click="deleteData(feature.id)" v-tooltip="__('Delete')"
                                            class="btn btn-sm">
                                            <DeleteIcon />
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
                    <Pagination :links="features.links" />
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span v-if="!isEditMode">{{ __('Feature Create') }}</span>
                        <span v-else>{{ __('Feature Edit') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="saveData">
                        <div class="mb-3">
                            <Label :name="__('Title')" for="name" />
                            <input v-model="form.title" type="text" class="form-control"
                                :class="{'is-invalid':form.errors.title}" id="name" :placeholder="__('Title')">
                            <ErrorMessage :name="form.errors.title" />
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Description')" />
                            <textarea v-model="form.description" rows="6" class="form-control"  :class="{'is-invalid':form.errors.description}"></textarea>
                            <ErrorMessage :name="form.errors.description"/>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing" />
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                {{ __('Save') }}
                            </span>
                        </button>
                        <button v-if="isEditMode" @click="cancelEdit" type="button" class="btn btn-danger ml-2">
                            <i class="fa-solid fa-times"></i>
                            {{ __('Cancel') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";

export default {
    props: {
        features: Object,
    },
    components: {
        Pagination,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: null,

            form: this.$inertia.form({
                title: "",
                description: "",
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            this.form.post(route("features.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editData(team) {
            this.isEditMode = true;
            this.selectedId = team.id;
            this.form.title = team.title;
            this.form.description = team.description;
        },
        cancelEdit() {
            this.isEditMode = false;
            this.form.reset();
        },
        updateData() {
            this.form.put(route("features.update", this.selectedId), {
                onSuccess: () => {
                    this.isEditMode = false;
                    this.form.reset();
                },
            });
        },
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
                    this.$inertia.delete(route("features.destroy", id));
                }
            });
        },
    },
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>

<style scoped>
    .avatar-img {
        height: 60px;
        width: 60px;
        object-fit: cover;
    }

    .table-avatar {
        height: 25px;
        width: 25px;
        object-fit: cover;
        border-radius: 50%;
        display: inline;
    }
</style>
