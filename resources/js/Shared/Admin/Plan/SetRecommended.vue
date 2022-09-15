<template>
    <div class="col-md-8">
        <div class="d-flex align-items-center my-3">
            <div class="form-row mr-3">
                <div class="col-auto">
                    <label for="" class="mr-sm-2">{{ __('Set Default Plan') }}</label>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="default_plan_id">
                        <option v-for="plan in plans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                </div>
                <div class="col-auto pt-30">
                    <button @click="setDefaultPlan" type="button" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
            <div class="form-row">
                <div class="col-auto">
                    <label for="" class="mr-sm-2">{{ __('Set Recommended Plan') }}</label>
                    <select name="plan_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="plan_id">
                        <option value="" hidden>{{ __('Select Plan') }}</option>
                        <option :selected="plan.recommended" v-for="plan in plans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                </div>
                <div class="col-auto pt-30">
                    <button @click="setRecommendedPlan" type="button" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        plans: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            plan_id: "",
            default_plan_id: 1,
        };
    },
    methods: {
        setRecommendedPlan() {
            this.$inertia.put(
                route("plans.set.recommended.plan", this.plan_id)
            );
        },
        setDefaultPlan() {
            this.$inertia.put(
                route("plans.set.default.plan", this.default_plan_id)
            );
        },
    },
    mounted() {
        // set recommended plan
        this.plans.find((plan) => {
            if (plan.recommended) {
                this.plan_id = plan.id;
            }
        });

        // set default plan
        this.plans.find((plan) => {
            if (plan.default) {
                this.default_plan_id = plan.id;
            }
        });
    },
};
</script>
