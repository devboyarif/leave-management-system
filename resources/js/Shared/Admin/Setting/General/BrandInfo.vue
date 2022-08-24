<template>
 <div class="card">
    <div class="card-body">
         <h6>{{ __('Brand Information') }} </h6>
        <hr>
    <form @submit.prevent="saveData">
        <div class="mb-3 row">
            <div class="col-md-6 form-group">
                <Label :name="__('App Name')" />
                <input v-model="form.app_name" type="text" class="form-control"
                    :class="{'is-invalid':form.errors.app_name}">
                <ErrorMessage :name="form.errors.app_name" />
            </div>
            <div class="col-md-6 form-group">
                <Label :name="__('App Email')" />
                <input v-model="form.app_email" type="text" class="form-control"
                    :class="{'is-invalid':form.errors.app_email}">
                <ErrorMessage :name="form.errors.app_email" />
            </div>
            <div class="col-md-6 form-group">
                <Label :name="__('App Contact Number')" />
                <input v-model="form.app_contact_number" type="text" class="form-control"
                    :class="{'is-invalid':form.errors.app_contact_number}">
                <ErrorMessage :name="form.errors.app_contact_number" />
            </div>
            <div class="col-md-6 form-group">
                <Label :name="__('App Copyright')" />
                <input v-model="form.app_copyright" type="text" class="form-control"
                    :class="{'is-invalid':form.errors.app_copyright}">
                <ErrorMessage :name="form.errors.app_copyright" />
            </div>
            <div class="col-md-12 form-group">
                <Label :name="__('App Location')" />
                <textarea v-model="form.app_location" rows="5" class="form-control"
                    :class="{'is-invalid':form.errors.app_location}"></textarea>
                <ErrorMessage :name="form.errors.app_location" />
            </div>
            <div class="col-md-4 form-group">
                <Label :name="__('App Dark Logo')" :required="false">
                    <InfoTip :title="__('Recommended Size') +' - 155 x 55'"/>
                </Label> <br>
                <input accept="image/jpeg, image/jpg/ image/png, image/svg" type="file"
                @change="onDarkLogoChange"

                    :class="{'is-invalid':form.errors.app_dark_logo}">
                <ErrorMessage :name="form.errors.app_dark_logo" />
                <div class="mt-4 bg-light">
                    <Label :name="__('Preview')" :required="false" /> <br>
                    <img :src="app_dark_logo_preview" alt="logo" height="50" width="150" class="object-cover-fit">
                </div>
            </div>
            <div class="col-md-4 form-group">
                <Label :name="__('App Light Logo')" :required="false" >
                    <InfoTip :title="__('Recommended Size') +' - 155 x 55'"/>
                </Label> <br>
                <input accept="image/jpeg, image/jpg/ image/png, image/svg" type="file" @change="onLightLogoChange"
                    :class="{'is-invalid':form.errors.app_light_logo}">
                    <ErrorMessage :name="form.errors.app_light_logo" />
                    <div class="mt-4">
                    <Label :name="__('Preview')" :required="false" /> <br>
                    <img :src="app_light_logo_preview" alt="logo" height="50" width="150" class="object-cover-fit bg-dark">
                </div>
            </div>
            <div class="col-md-4 form-group">
                <Label :name="__('App Favicon')" :required="false">
                    <InfoTip :title="__('Recommended Size') +' - 32 x 32'"/>
                </Label> <br>
                <input accept="image/jpeg, image/jpg/ image/png, image/svg" type="file" @change="onFaviconChange"
                    :class="{'is-invalid':form.errors.app_favicon}">
                <ErrorMessage :name="form.errors.app_favicon" />
                <div class="mt-4">
                    <Label :name="__('Preview')" :required="false" /> <br>
                    <img :src="app_favicon_preview" alt="logo" height="32" width="32" class="object-cover-fit">
                </div>
            </div>
        </div>
        <button :disabled="submitButtonDisabled" type="submit" class="btn btn-primary">
            <Loading v-if="form.processing" message="Saving..." />
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
    props: { setting: Object },
    data() {
        return {
            form: this.$inertia.form({
                app_name: this.setting.app_name,
                app_email: this.setting.app_email,
                app_contact_number: this.setting.app_contact_number,
                app_copyright: this.setting.app_copyright,
                app_location: this.setting.app_location,
                app_dark_logo: "",
                app_light_logo: "",
                app_favicon: "",
                type: "brand_info",
            }),

            app_dark_logo_preview: this.setting.app_dark_logo,
            app_light_logo_preview: this.setting.app_light_logo,
            app_favicon_preview: this.setting.app_favicon,
        };
    },
    methods: {
        saveData() {
            this.form.post(route("settings.general.update"));
        },
        onDarkLogoChange(e) {
            const file = e.target.files[0];
            this.app_dark_logo_preview = URL.createObjectURL(file);
            this.form.app_dark_logo = file;
        },
        onLightLogoChange(e) {
            const file = e.target.files[0];
            this.app_light_logo_preview = URL.createObjectURL(file);
            this.form.app_light_logo = file;
        },
        onFaviconChange(e) {
            const file = e.target.files[0];
            this.app_favicon_preview = URL.createObjectURL(file);
            this.form.app_favicon = file;
        },
    },
    watch: {
        data: {
            handler() {
                this.app_name = this.setting.app_name;
                this.app_email = this.setting.app_email;
                this.app_contact_number = this.setting.app_contact_number;
                this.app_copyright = this.setting.app_copyright;
                this.app_location = this.setting.app_location;
                this.app_dark_logo_preview = this.setting.app_dark_logo;
                this.app_light_logo_preview = this.setting.app_light_logo;
                this.app_favicon_preview = this.setting.app_favicon;
            },
            deep: true,
        },
    },
};
</script>

<style scoped>
.object-cover-fit {
    object-fit: cover;
}
</style>
