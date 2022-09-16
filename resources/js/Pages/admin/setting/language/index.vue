<template>
    <Head :title="__('Language List')"/>

     <div class="row">
        <div class="col-6">
             <div class="d-flex align-items-center mb-1 mt-3">
                <div class="form-row">
                    <div class="col-auto">
                        <label for="" class="mr-sm-2">{{ __('Set Default Language') }}</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="default_language">
                            <option v-for="language in languages" :key="language.id" :value="language.id">
                                {{ language.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-auto pt-30">
                        <button @click="setDefaultLanguage" type="button" class="btn btn-primary ">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Language List') }}</span>
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Code') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="languages && languages.length">
                                    <tr v-for="(language,index) in languages" :key="index">
                                        <td>
                                            {{ language.name }}
                                            <span class="badge badge-primary" v-if="language.id == defaultLanguage">
                                                {{ __('Default') }}
                                            </span>
                                        </td>
                                        <td>{{ language.code }}</td>
                                        <td>
                                            <label class="switch ">
                                                <input @change="languageStatusUpdate(language.id)" type="checkbox" class="success toggle-switch" :checked="language.status">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="d-flex">
                                            <Link :href="route('languages.translation.edit', language.id)" v-tooltip="__('Translate Language')" class="btn btn-sm  pl-0">
                                                 <i class="fa-solid fa-cog fa-2x text-secondary"></i>
                                            </Link>
                                            <button @click="editLanguage(language)" v-tooltip="__('Language Edit')" class="btn btn-sm ">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(language.id)" v-tooltip="__('Language Delete')" class="btn btn-sm">
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
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span v-if="!isEditMode">{{ __('Language Create') }}</span>
                            <span v-else>{{ __('Language Edit') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                         <form @submit.prevent="saveData">
                            <div class="mb-3">
                                <Label :name="__('Name')"/>
                                 <select class="form-control" :class="{'is-invalid':form.errors.name}" v-model="form.name" @change="languageAutoComplete">
                                    <option value="" class="d-none">{{ __('Select Language') }}</option>
                                    <option v-for="(langInfo,key) in langInfos" :key="key" :value="langInfo['name']">{{ langInfo['name'] }}</option>
                                </select>
                                <ErrorMessage :name="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <Label :name="__('Code')"/>
                                  <select class="form-control" :class="{'is-invalid':form.errors.code}" v-model="form.code">
                                    <option value="" class="d-none">{{ __('Select Language Code') }}</option>
                                    <option v-for="(langInfo,key) in langInfos" :key="key" :value="key">{{ key }}</option>
                                </select>
                                <ErrorMessage :name="form.errors.code" />
                            </div>
                            <div class="mb-3">
                                <Label :name="__('Status')" :required="false"/> <br>
                                <label class="switch ">
                                    <input @change="statusChange" v-model="form.status" type="checkbox" class="success toggle-switch" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing" message="Saving..."/>
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
export default {
    layout: 'Setting',
    props: {
        languages: Array,
        langInfos: Array,
        defaultLanguage: Number,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: "",
            default_language: this.defaultLanguage,
            languageStatus: false,
            form: this.$inertia.form({
                name: "",
                code: "",
                status: true,
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            this.form.post(route("languages.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editLanguage(language) {
            this.isEditMode = true;
            this.selectedId = language.id;
            this.form.name = language.name;
            this.form.code = language.code;
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
        languageStatusUpdate(id) {
            this.$inertia.put(route("languages.status.update", id));
        },
        statusChange(event) {
            this.form.status = event.target.checked;
        },
        setDefaultLanguage() {
            this.$inertia.put(
                route("languages.set.default", this.default_language)
            );
        },
        languageAutoComplete(){
            let objects = Object.keys(this.langInfos);
            for (let i = 0; i < objects.length; i++) {
                if (this.langInfos[objects[i]]['name'] == this.form.name) {
                    this.form.code = this.langInfos[objects[i]]['code'];
                }
            }
        },
    },
     mounted(){
        this.checkPagePermission('admin')
    }
};
</script>


<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 35px;
        height: 19px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 3px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.success:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(15px);
        -ms-transform: translateX(15px);
        transform: translateX(15px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
