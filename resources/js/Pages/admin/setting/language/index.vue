<template>
    <Head title="Admin List"/>

    <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Language List</span>
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Direction</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="languages && languages.length">
                                    <tr v-for="(language,index) in languages" :key="index">
                                        <td>{{ language.name }}</td>
                                        <td>{{ language.code }}</td>
                                        <td>{{ language.direction }}</td>
                                        <td class="d-flex">
                                            <button @click="editLanguage(language)" v-tooltip="'Edit Language'" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(language.id)" v-tooltip="'Delete Language'" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h6>No DataFound</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span v-if="!isEditMode">Create Language</span>
                            <span v-else>Edit Language</span>
                        </div>
                    </div>
                    <div class="card-body">
                         <form @submit.prevent="saveData">
                            <div class="mb-3">
                                <Label name="Name">
                                    <Info text="Provide a language name e.g: English, Bangla"/>
                                </Label>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.name}" id="name" placeholder="Name">
                                <ErrorMessage :name="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <Label name="Code">
                                     <Info text="Provide language code e.g: en, bn"/>
                                </Label>
                                <input v-model="form.code" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.code}" id="name" placeholder="Code">
                                <ErrorMessage :name="form.errors.code" />
                            </div>
                            <div class="mb-3">
                                <Label name="Direction"/>
                                <select class="form-control" :class="{'is-invalid':form.errors.direction}" v-model="form.direction">
                                    <option value="ltr">LTR</option>
                                    <option value="rtl">RTL</option>
                                </select>
                                <ErrorMessage :name="form.errors.direction" />
                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing" message="Saving..."/>
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    Save
                                </span>
                            </button>
                            <button v-if="isEditMode" @click="cancelEdit" type="button" class="btn btn-danger ml-2">
                                <i class="fa-solid fa-times"></i>
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
import Info from "../../../../Shared/Forms/Info.vue";
export default {
    props: {
        languages: Array,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: "",
            // search: this.filters.search,
            form: this.$inertia.form({
                name: "",
                code: "",
                direction: "ltr",
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            console.log(this.form);
            this.form.post(route("languages.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editLanguage(language) {
            console.log(language);
            this.isEditMode = true;
            this.selectedId = language.id;
            this.form.name = language.name;
            this.form.code = language.code;
            this.form.direction = language.direction;
        },
        cancelEdit() {
            this.isEditMode = false;
            this.form.reset();
        },
        updateData() {
            this.form.put(route("languages.update", this.selectedId), {
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
                    this.$inertia.delete(route("languages.destroy", id));
                }
            });
        },
        companyWiseTeam() {
            this.filterForm.get(route("teams.index"));
        },
    },
    components: { Info },
};
</script>

