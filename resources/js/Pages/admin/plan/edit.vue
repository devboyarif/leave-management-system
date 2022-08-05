<template>
    <Head :title="__('Plan Edit')"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Plan Edit') }}</h3>
                        <Link :href="route('plans.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="updateData">
                        <div class="mb-3 row">
                           <div class="col-md-6">
                                <Label :name="__('Name')"/>
                                <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" id="name">
                                <ErrorMessage :name="form.errors.name"/>
                            </div>
                           <div class="col-md-6">
                                <Label :name="__('Plan Type')"/>
                                <select class="form-control" v-model="form.type" :class="{'is-invalid':form.errors.type}">
                                    <option value="paid">{{ __('Paid') }}</option>
                                    <option value="free">{{ __('Free') }}</option>
                                </select>
                                <ErrorMessage :name="form.errors.type"/>
                           </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Price')"/>
                                <input v-model="form.price" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.price}">
                                <ErrorMessage :name="form.errors.price" />
                            </div>
                             <div class="col-md-6">
                                <Label :name="__('Subscription Type')"/>
                                <select class="form-control" v-model="form.interval" :class="{'is-invalid':form.errors.interval}">
                                    <option value="monthly">{{ __('Monthly') }}</option>
                                    <option value="yearly">{{ __('Yearly') }}</option>
                                    <option value="custom_days">{{ __('Custom Days') }}</option>
                                    <option value="lifetime">{{ __('Lifetime') }}</option>
                                </select>
                                <ErrorMessage :name="form.errors.interval"/>
                           </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6" v-if="showCustomIntervalField">
                                <Label :name="__('Number of Days')"/>
                                <input v-model="form.custom_interval_days" type="number" class="form-control"
                                    :class="{'is-invalid':form.errors.custom_interval_days}" >
                                <ErrorMessage :name="form.errors.custom_interval_days" />
                           </div>
                            <div class="col-md-6">
                                <Label :name="__('Status')"/> <br>
                                <label class="switch ">
                                    <input @change="statusChange" v-model="form.status" type="checkbox" class="success toggle-switch" :checked="form.status">
                                    <span class="slider round"></span>
                                </label>

                                <ErrorMessage :name="form.errors.status" className="d-block"/>
                           </div>
                        </div>
                        <h4 class="mt-2">{{ __('Plan Features') }}</h4>
                        <div class="mb-3 row">
                             <div class="col-md-6">
                                <Label :name="__('Employee Adding Type')"/>
                                <select class="form-control" v-model="form.is_limited_employee" :class="{'is-invalid':form.errors.is_limited_employee}">
                                    <option value="1">{{ __('Limited Employee') }}</option>
                                    <option value="0">{{ __('Unlimited Employee') }}</option>
                                </select>
                                <ErrorMessage :name="form.errors.interval"/>
                           </div>
                            <div class="col-md-6" v-if="showMaxEmployeeField">
                                <Label :name="__('Max Employees')"/>
                                <input v-model="form.max_employees" type="number" class="form-control"
                                    :class="{'is-invalid':form.errors.max_employees}" min="1">
                                <ErrorMessage :name="form.errors.max_employees" />
                           </div>
                            <div class="col-md-6 my-2">
                                <Label :name="__('Max Teams')"/>
                                <input v-model="form.max_teams" type="number" class="form-control"
                                    :class="{'is-invalid':form.errors.max_teams}" min="1">
                                <ErrorMessage :name="form.errors.max_teams" />
                           </div>
                            <div class="col-md-6 my-2">
                                <Label :name="__('Max Leave Types')"/>
                                <input v-model="form.max_leave_types" type="number" class="form-control"
                                    :class="{'is-invalid':form.errors.max_leave_types}" min="1">
                                <ErrorMessage :name="form.errors.max_leave_types" />
                           </div>
                           <div class="col-md-6" :class="{'mt-2': !showMaxEmployeeField}">
                                <Label :name="__('Custom Theme Look')"/> <br>
                                <label class="switch ">
                                    <input @change="customLookStatusChange" v-model="form.custom_theme_look" type="checkbox" class="success toggle-switch" :checked="form.custom_theme_look">
                                    <span class="slider round"></span>
                                </label>

                                <ErrorMessage :name="form.errors.custom_theme_look" className="d-block"/>
                           </div>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing" message="Saving..."/>
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
    props: {
        plan: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.plan.name,
                type: this.plan.type,
                price: this.plan.price,
                interval: this.plan.interval,
                custom_interval_days: this.plan.custom_interval_days,
                status: this.plan.status ? true : false,

                // plan features
                is_limited_employee: this.plan.plan_features
                    ? this.plan.plan_features.is_limited_employee
                    : 0,
                max_employees: this.plan.plan_features
                    ? this.plan.plan_features.max_employees
                    : 1,
                max_teams: this.plan.plan_features
                    ? this.plan.plan_features.max_teams
                    : 1,
                max_leave_types: this.plan.plan_features
                    ? this.plan.plan_features.max_leave_types
                    : 1,
                custom_theme_look:
                    this.plan.plan_features &&
                    this.plan.plan_features.custom_theme_look
                        ? true
                        : false,
            }),

            showCustomIntervalField:
                this.plan.interval === "custom_days" ? true : false,
            showMaxEmployeeField:
                this.plan.plan_features &&
                this.plan.plan_features.is_limited_employee
                    ? true
                    : false,
        };
    },
    watch: {
        "form.interval": function (val) {
            if (val == "custom_days") {
                this.showCustomIntervalField = true;
            } else {
                this.showCustomIntervalField = false;
            }
        },
        "form.is_limited_employee": function (val) {
            if (val == 1) {
                this.showMaxEmployeeField = true;
            } else {
                this.showMaxEmployeeField = false;
            }
        },
    },
    methods: {
        updateData() {
            this.form.put(route("plans.update", this.plan.id), {
                onSuccess: () => this.form.reset(),
            });
        },
        statusChange(event) {
            this.form.status = event.target.checked;
        },
        customLookStatusChange(event) {
            this.form.custom_theme_lookup = event.target.checked;
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
