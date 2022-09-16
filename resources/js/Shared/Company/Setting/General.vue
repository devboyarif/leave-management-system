<template>
    <div class="card">
        <div class="card-body ">
            <h6>{{ __('Profile Information') }}</h6>
            <hr>
            <form class="form-horizontal" autocomplete="off" @submit.prevent="profileUpdate">
                <div class="form-group position-relative">
                    <Label :name="__('Logo')" />
                    <img :src="previewImage" alt="image" class="d-block ui-w-100 rounded-circle" id="image">
                    <div class="profile-edit font-weight-bold" v-tooltip="__('Edit')">
                        <a href="" @click.prevent="$refs.profileimage.click()">
                            <svg aria-hidden="true" height="26" viewBox="0 0 16 16" version="1.1" width="26"
                                data-view-component="true" class="octicon octicon-pencil">
                                <path fill-rule="evenodd"
                                    d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <input type="file" ref="profileimage" hidden accept="image/jpeg, image/jpg/ image/png"
                        @input="form.avatar = $event.target.files[0]" autocomplete="image"
                        onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="form-group">
                    <Label :name="__('Name')" />
                    <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" placeholder="Enter New Name">
                    <ErrorMessage :name="form.errors.name" />
                </div>
                <div class="form-group">
                    <Label :name="__('Email')" />
                    <input v-model="form.email" type="email" class="form-control " placeholder="Enter New Email"
                        :class="{'is-invalid':form.errors.email}">
                    <ErrorMessage :name="form.errors.email" />
                </div>
                 <div class="form-group">
                    <Label :name="__('Country')"/>
                    <select v-model="form.country" class="form-control" :class="{'is-invalid':form.errors.country}">
                        <option value="" class="d-none">{{ __('Select Country') }}</option>
                        <option :value="country.id" v-for="country in countries" :key="country.id">
                            {{ country.name }}
                        </option>
                    </select>
                    <ErrorMessage :name="form.errors.country"/>
                </div>
                <button :disabled="form.processing" type="submit" class="btn btn-primary">
                    <Loading v-if="form.processing" />
                    <span v-else>
                        <i class="fa-solid fa-check mr-1"></i>
                        {{ __('Save') }}
                    </span>
                </button>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h6>{{ __('Delete Company') }}</h6>
            <hr>
            <div class="form-group">
                <label class="d-block text-danger">{{ __('Delete Company') }}</label>
                <p class="text-muted font-size-sm">{{ __('Once you delete your company it will delete all data including teams employees and leaves') }}</p>
            </div>
            <button @click="deleteCompany" class="btn btn-danger" type="button">{{ __('Delete Company') }}</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
        company: Object,
        countries: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.company.company_name,
                email: this.company.company_email,
                avatar: null,
                country: this.company ? this.company.country_id : "",
            }),

            previewImage: this.company.company_logo,
        };
    },
    methods: {
        async changeTab(tab) {
            this.currentTab = tab;
        },
        profileUpdate() {
            this.form.post(route("company.general.setting.update"),{
                onSuccess: () => window.location.reload()
            });
        },
        deleteCompany() {
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
                    this.$inertia.delete(route("company.delete"), {
                        onSuccess: () => window.location.reload()
                    });
                }
            });
        }
    },
    watch: {
        user: {
            handler() {
                this.form.name = this.company.company_name;
                this.form.email = this.company.company_email;
                this.form.avatar = this.company.company_logo;
                this.previewImage = this.company.company_logo;
            },
            deep: true,
        },
    },
};
</script>

<style scoped>
.ui-w-100 {
    width: 180px !important;
    height: 180px !important;
    object-fit: cover !important;
}
.profile-edit {
    position: absolute;
    top: 170px;
    left: 5px;
}
</style>
