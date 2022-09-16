<template>

    <Head :title="__('Leave Type Create')" />
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Leave Type Create') }}</h3>
                        <Link :href="route('company.leaveTypes.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="createData">
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <Label :name="__('Name')" />
                                    <input v-model="form.name" type="text" class="form-control"
                                        :class="{'is-invalid':form.errors.name}" id="name">
                                    <ErrorMessage :name="form.errors.name" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <Label :name="__('Color')" :required="false" />
                                    <input v-model="form.color" class="form-control" type="color"
                                        :class="{'is-invalid':form.errors.color}" />
                                    <ErrorMessage :name="form.errors.color" />
                                </div>
                                <div class="col-lg-6">
                                    <Label :name="__('Leave Balance Day')" :required="false"/>
                                    <input min="1" v-model="form.balance" class="form-control" type="number"
                                        :class="{'is-invalid':form.errors.balance}" />
                                    <ErrorMessage :name="form.errors.balance" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <Label :name="__('Status')" :required="false"/> <br>
                                    <label class="switch ">
                                        <input @change="statusChange" v-model="form.status" type="checkbox" class="success toggle-switch" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <div class="custom-control custom-checkbox">
                                        <input v-model="form.auto_approve" type="checkbox" class="custom-control-input"
                                            id="auto_approve">
                                        <label class="custom-control-label" for="auto_approve">{{ __('Allow auto approve') }}</label>
                                    </div>
                                </div>

                            </div>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <Loading v-if="form.processing"/>
                                <span v-else>
                                    <i class="fa-solid fa-check mr-1"></i>
                                    {{ __('Save') }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                color: "#ABB8C3",
                balance: 7,
                auto_approve: false,
                status: true,
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("company.leaveTypes.store"));
        },
        statusChange(event) {
            this.form.status = event.target.checked;
        },
    },
     mounted(){
        this.checkPagePermission('owner')
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
