<template>

    <Head :title="__('Pricing Plan')" />

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12" v-for="plan in plans" :key="plan.id">
            <div class="card h-100 shadow-sm">
                <div class="card-header text-center py-4">
                    <h4>
                        <b>{{ plan.name }}</b>
                        <small v-if="plan.interval != 'custom_days'"> /{{ plan.interval }}</small>
                        <small v-else> /{{ plan.custom_interval_days }} {{ __('Days') }}</small>
                    </h4>
                    <div class="badge badge-info" v-if="plan.recommended">{{ __('Recommended') }}</div>
                    <h1 class="text-dark">
                        ${{ plan.price }}
                    </h1>
                </div>
                <div class="card-body" v-if="plan.plan_features">
                   <Feature name="Unlimited Employees" :checked="!plan.plan_features.is_limited_employee"/>
                   <Feature name="Max Employees" :checked="true" :value="plan.plan_features.is_limited_employee ? plan.plan_features.max_employees : '∞'"/>
                   <Feature name="Max Teams" :checked="true" :value="plan.plan_features.max_teams"/>
                   <Feature name="Max Leave Types" :checked="true" :value="plan.plan_features.max_leave_types"/>
                   <Feature name="Custom Theme Look" :checked="plan.plan_features.custom_theme_look"/>
                </div>
                <div class="card-footer">
                    <div class=" d-flex justify-content-between">
                        <template v-if="subscription.plan_id == plan.id">
                        <button type="button" class="btn btn-success">
                            {{ __('Current Plan') }}
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-danger w-100-p" v-if="plan.type != 'free'">
                            {{ __('Cancel Plan') }}
                            <i class="fas fa-times"></i>
                        </button>

                        </template>
                        <a v-else :href="route('website.plan.details', plan.slug)" class="btn btn-primary">
                            {{ __('Select Plan') }}
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Feature from "../../Shared/Admin/Plan/Feature.vue";

export default {
    components: {
        Feature,
    },
    props: {
        plans: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            subscription: this.$page.props.current_subscription,
        };
    },
};
</script>
