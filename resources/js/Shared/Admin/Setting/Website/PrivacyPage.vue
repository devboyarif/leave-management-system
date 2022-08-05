<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Privacy Policy Content')" />
                     <textarea v-model="form.privacy_description" class="form-control" :class="{'is-invalid':form.errors.privacy_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.privacy_description" />
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
                privacy_description: this.cms.privacy_description,
                type: 'privacy',
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
                this.form.privacy_description = this.cms.privacy_description;
            },
            deep: true,
        },
    },
};
</script>
