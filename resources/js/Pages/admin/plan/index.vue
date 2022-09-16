<template>

    <Head :title="__('Plan')" />
    <div class="row align-items-end justify-content-center">
        <!-- Set Recommended Plan -->
        <SetRecommended :plans="plans"/>

        <div class="col-md-4 d-flex mb-3 justify-content-end">
            <Link :href="route('plans.create')" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i>
                {{ __('Create Plan') }}
            </Link>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12" v-for="plan in plans" :key="plan.id">
            <div class="card h-100 shadow-sm">
                <div class="card-header text-center py-4">
                    <h4>
                        <b>{{ plan.name }}</b>
                        <small v-if="plan.interval != 'custom_days'"> /{{ plan.interval }}</small>
                        <small v-else> /{{ plan.custom_interval_days }} {{ __('Days') }}</small>
                    </h4>
                    <template v-if="plan.recommended">
                    <div class="badge badge-info">{{ __('Recommended') }}</div><br>

                    </template>
                    <template v-if="plan.default">
                    <div class="badge badge-success">{{ __('Default') }}</div>

                    </template>
                    <h1 class="text-dark">
                        {{ currencyPosition(plan.price) }}
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
                        <Link :href="route('plans.edit', plan.id)" class="btn btn-primary"  v-tooltip="__('Edit')">
                             <i class="fas fa-edit"></i>
                            {{ __('Edit') }}
                        </Link>
                        <button @click="deleteData(plan.id)" v-tooltip="__('Delete')" class="btn btn-danger w-100-p" v-if="!plan.default">
                            <i class="fas fa-trash"></i>
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Feature from "../../../Shared/Admin/Plan/Feature.vue";
import SetRecommended from "../../../Shared/Admin/Plan/SetRecommended.vue";

export default {
    components: {
        Feature,
        SetRecommended,
    },
    props: {
        plans: {
            type: Array,
            required: true,
        },
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
                    this.$inertia.delete(route("plans.destroy", id));
                }
            });
        },
    },
    mounted() {
        this.checkPagePermission('admin')
    },
};
</script>
