<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Pricing Plan Title')" />
                    <input v-model="form.pricing_plan_title" type="text" class="form-control" :class="{'is-invalid':form.errors.pricing_plan_title}">
                    <ErrorMessage :name="form.errors.pricing_plan_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('Pricing Plan Description')" />
                    <textarea v-model="form.pricing_plan_description" class="form-control" :class="{'is-invalid':form.errors.pricing_plan_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.pricing_plan_description" />
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
</template>

<script>
export default {
    props: {
        cms: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                pricing_plan_title: this.cms.pricing_plan_title,
                pricing_plan_description: this.cms.pricing_plan_description,
                type: 'plan',
            }),
        };
    },
    methods: {
        updateData() {
            this.form.put(route("settings.cms.update"));
        }
    },
    watch: {
        data: {
            handler() {
                this.form.pricing_plan_title = this.cms.pricing_plan_title;
                this.form.pricing_plan_description = this.cms.pricing_plan_description;
            },
            deep: true,
        },
    },
};
</script>
