<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Contact Title')" />
                    <input v-model="form.contact_title" type="text" class="form-control" :class="{'is-invalid':form.errors.contact_title}">
                    <ErrorMessage :name="form.errors.contact_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('Contact Subtitle')" />
                    <input v-model="form.contact_subtitle" type="text" class="form-control" :class="{'is-invalid':form.errors.contact_subtitle}">
                    <ErrorMessage :name="form.errors.contact_subtitle" />
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
                contact_title: this.cms.contact_title,
                contact_subtitle: this.cms.contact_subtitle,
                type: 'contact',
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
                this.form.contact_title = this.cms.contact_title;
                this.form.contact_subtitle = this.cms.contact_subtitle;
            },
            deep: true,
        },
    },
};
</script>
