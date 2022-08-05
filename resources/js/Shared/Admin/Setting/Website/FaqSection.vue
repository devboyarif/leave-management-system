<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('FAQ Title')" />
                    <input v-model="form.faq_title" type="text" class="form-control" :class="{'is-invalid':form.errors.faq_title}">
                    <ErrorMessage :name="form.errors.faq_title" />
                </div>
                <div class="form-group">
                    <Label :name="__('FAQ Subtitle')" />
                    <input v-model="form.faq_subtitle" type="text" class="form-control" :class="{'is-invalid':form.errors.faq_subtitle}">
                    <ErrorMessage :name="form.errors.faq_subtitle" />
                </div>
                <div class="form-group">
                    <Label :name="__('FAQ Description')" />
                     <textarea v-model="form.faq_description" class="form-control" :class="{'is-invalid':form.errors.faq_description}" rows="4"></textarea>
                    <ErrorMessage :name="form.errors.faq_description" />
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
                faq_title: this.cms.faq_title,
                faq_subtitle: this.cms.faq_subtitle,
                faq_description: this.cms.faq_description,
                type: 'faq',
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
                this.form.faq_title = this.cms.faq_title;
                this.form.faq_subtitle = this.cms.faq_subtitle;
                this.form.faq_description = this.cms.faq_description;
            },
            deep: true,
        },
    },
};
</script>
