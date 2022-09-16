<template>
    <Head :title="__('Currency List')"/>

    <div class="row">
        <div class="col-6">
             <div class="d-flex align-items-center mb-1 mt-3">
                <div class="form-row">
                    <div class="col-auto">
                        <label for="" class="mr-sm-2">{{ __('Set Default Currency') }}</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="default_currency">
                            <option v-for="currency in currencies" :key="currency.id" :value="currency.id">
                                {{ currency.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-auto pt-30">
                        <button @click="setDefaultCurrency" type="button" class="btn btn-primary">{{ __('Save') }}</button>
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
                        <span>{{ __('Currency List') }}</span>
                    </div>
                </div>
                    <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Symbol') }}</th>
                                <th>{{ __('Symbol Position') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="currencies && currencies.length">
                                <tr v-for="(currency,index) in currencies" :key="index">
                                    <td>
                                        {{ currency.name }}
                                        <span class="badge badge-primary" v-if="defaultCurrency.id == currency.id">
                                            {{ __('Default') }}
                                        </span>
                                    </td>
                                    <td>{{ currency.code }}</td>
                                    <td>{{ currency.symbol }}</td>
                                    <td>{{ currency.symbol_position }}</td>
                                    <td>
                                        <label class="switch ">
                                            <input @change="currencyStatusUpdate(currency.id)" type="checkbox" class="success toggle-switch" :checked="currency.status">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex">
                                        <button @click="editCurrency(currency)" v-tooltip="__('Edit')" class="btn btn-sm ">
                                            <EditIcon/>
                                        </button>
                                        <button @click="deleteData(currency.id)" v-tooltip="__('Delete')" class="btn btn-sm">
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
                        <span v-if="!isEditMode">{{ __('Currency Create') }}</span>
                        <span v-else>{{ __('Currency Edit') }}</span>
                    </div>
                </div>
                <div class="card-body">
                        <form @submit.prevent="saveData">
                        <div class="mb-3">
                            <Label :name="__('Name')"/>
                                <select class="form-control" :class="{'is-invalid':form.errors.name}" v-model="form.name" @change="currencyAutoComplete">
                                <option value="" class="d-none">{{ __('Select One') }}</option>
                                <option v-for="(currency,key) in currencyInfos" :key="key" :value="currency['name']">{{ currency['name'] }}</option>
                            </select>
                            <ErrorMessage :name="form.errors.name" />
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Code')"/>
                                <select class="form-control" :class="{'is-invalid':form.errors.code}" v-model="form.code">
                                <option value="" class="d-none">{{ __('Select One') }}</option>
                                <option v-for="(currency,key) in currencyInfos" :key="key" :value="currency['code']">{{ currency['code'] }}</option>
                            </select>
                            <ErrorMessage :name="form.errors.code" />
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Symbol')"/>
                                <select class="form-control" :class="{'is-invalid':form.errors.symbol}" v-model="form.symbol">
                                <option value="" class="d-none">{{ __('Select One') }}</option>
                                <option v-for="(currency,key) in currencyInfos" :key="key" :value="currency['symbol_native']">{{ currency['symbol_native'] }}</option>
                            </select>
                            <ErrorMessage :name="form.errors.symbol" />
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Symbol Position')"/>
                            <select class="form-control" :class="{'is-invalid':form.errors.symbol_position}" v-model="form.symbol_position">
                                <option value="left">{{ __('Left') }}</option>
                                <option value="left">{{ __('Right') }}</option>
                            </select>
                            <ErrorMessage :name="form.errors.symbol_position" />
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
        currencies: Array,
        currencyInfos: Array,
        defaultCurrency: Object,
    },
    data() {
        return {
            isEditMode: false,
            selectedId: "",
            default_currency: this.defaultCurrency.id,
            form: this.$inertia.form({
                name: "",
                code: "",
                symbol: "",
                symbol_position: "left",
                status: true,
            }),
        };
    },
    methods: {
        saveData() {
            this.isEditMode ? this.updateData() : this.createData();
        },
        createData() {
            this.form.post(route("settings.currency.store"), {
                onSuccess: () => this.form.reset(),
            });
        },
        editCurrency(currency) {
            this.isEditMode = true;
            this.selectedId = currency.id;
            this.form.name = currency.name;
            this.form.code = currency.code;
            this.form.symbol = currency.symbol;
            this.form.symbol_position = currency.symbol_position;
            this.form.status = currency.status;
        },
        cancelEdit() {
            this.isEditMode = false;
            this.form.reset();
        },
        updateData() {
            this.form.put(route("settings.currency.update", this.selectedId), {
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
                    this.$inertia.delete(route("settings.currency.destroy", id));
                }
            });
        },
        currencyStatusUpdate(id) {
            this.$inertia.put(route("settings.currency.status.update", id));
        },
        statusChange(event) {
            this.form.status = event.target.checked;
        },
        currencyAutoComplete(){
            let objects = Object.keys(this.currencyInfos);
            for (let i = 0; i < objects.length; i++) {
                if (this.currencyInfos[objects[i]]['name'] == this.form.name) {
                    this.form.code = this.currencyInfos[objects[i]]['code'];
                    this.form.symbol = this.currencyInfos[objects[i]]['symbol_native'];
                }
            }
        },
        setDefaultCurrency() {
            this.$inertia.put(
                route("settings.currency.set.default", this.default_currency)
            );
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
