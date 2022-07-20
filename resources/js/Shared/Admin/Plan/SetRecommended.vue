<template>
    <div class="col-md-8">
        <div class="d-flex align-items-center my-3">
            <div class="form-row align-items-end">
                <div class="col-auto">
                    <label for="" class="mr-sm-2">{{ __('Set Recommended Plan') }}</label>
                    <select name="plan_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect" v-model="plan_id">
                        <option value="" hidden>{{ __('Select Plan') }}</option>
                        <option :selected="plan.recommended" v-for="plan in plans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                </div>
                <div class="col-auto">
                    <button @click="setRecommendedPlan" type="button" class="btn btn-primary "
                        style="margin-top:30px">{{ __('Save') }}</button>
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
        };
    },
    methods: {
        setRecommendedPlan() {
            this.$inertia.put(
                route("plans.set.recommended.plan", this.plan_id)
            );
            // this.form.post(route("leaveRequests.store"))
            // console.log(this.plan_id);
            // this.$store.dispatch("setRecommendedPlan", this.plan_id);
        },
    },
};
</script>
