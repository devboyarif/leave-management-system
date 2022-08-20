<template>
 <div class="card">
    <div class="card-body">
        <h6>{{ __('Social Media') }}</h6>
        <hr>
        <form @submit.prevent="saveData">
            <div class="mb-3 row">
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Facebook')" />
                    <input v-model="form.facebook" type="text" class="form-control" :class="{'is-invalid':form.errors.facebook}">
                    <ErrorMessage :name="form.errors.facebook" />
                </div>
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Twitter')" />
                    <input v-model="form.twitter" type="text" class="form-control" :class="{'is-invalid':form.errors.twitter}">
                    <ErrorMessage :name="form.errors.twitter" />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Linkedin')" />
                    <input v-model="form.linkedin" type="text" class="form-control" :class="{'is-invalid':form.errors.linkedin}">
                    <ErrorMessage :name="form.errors.linkedin" />
                </div>
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Youtube')" />
                    <input v-model="form.youtube" type="text" class="form-control" :class="{'is-invalid':form.errors.youtube}">
                    <ErrorMessage :name="form.errors.youtube" />
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Instagram')" />
                    <input v-model="form.instagram" type="text" class="form-control" :class="{'is-invalid':form.errors.instagram}">
                    <ErrorMessage :name="form.errors.instagram" />
                </div>
                <div class="col-md-6 form-group">
                    <Label :required="false" :name="__('Pinterest')" />
                    <input v-model="form.pinterest" type="text" class="form-control" :class="{'is-invalid':form.errors.pinterest}">
                    <ErrorMessage :name="form.errors.pinterest" />
                </div>
            </div>
            <button :disabled="submitButtonDisabled" type="submit" class="btn btn-primary">
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
    data() {
        return {
            form: this.$inertia.form({
                facebook: this.$page.props.setting.facebook,
                twitter: this.$page.props.setting.twitter,
                linkedin: this.$page.props.setting.linkedin,
                youtube: this.$page.props.setting.youtube,
                instagram: this.$page.props.setting.instagram,
                pinterest: this.$page.props.setting.pinterest,
                type: "social_media",
            }),
        };
    },
    methods: {
        saveData() {
            this.form.post(route("settings.general.update"));
        },
    },
};
</script>
