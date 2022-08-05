<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Testimonial Title')" />
                    <input v-model="form.testimonial_title" type="text" class="form-control" :class="{'is-invalid':form.errors.testimonial_title}">
                    <ErrorMessage :name="form.errors.testimonial_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('Testimonial Subtitle')" />
                    <input v-model="form.testimonial_subtitle" type="text" class="form-control" :class="{'is-invalid':form.errors.testimonial_subtitle}">
                    <ErrorMessage :name="form.errors.testimonial_subtitle" />
                </div>
                <div class="form-group">
                    <Label :name="__('Testimonial Description')" />
                     <textarea v-model="form.testimonial_description" class="form-control" :class="{'is-invalid':form.errors.testimonial_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.testimonial_description" />
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
                testimonial_title: this.cms.testimonial_title,
                testimonial_subtitle: this.cms.testimonial_subtitle,
                testimonial_description: this.cms.testimonial_description,
                type: 'testimonial',
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
                this.form.testimonial_title = this.cms.testimonial_title;
                this.form.testimonial_subtitle = this.cms.testimonial_subtitle;
                this.form.testimonial_description = this.cms.testimonial_description;
            },
            deep: true,
        },
    },
};
</script>
