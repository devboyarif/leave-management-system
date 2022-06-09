<template>

    <Head title="Profile" />

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img id="image" :src="preview_image" alt="Admin"
                                    class="rounded-circle position-relative" width="150" height="150">

                                <div class="mt-3">
                                    <h4>{{ user.name }}</h4>
                                    <p class="text-secondary mb-1">Admin</p>
                                    <p class="text-secondary mb-1">Member Since: 1 july 2020</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                   {{ user.name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.email }}
                                </div>
                            </div>
                            <!-- <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    (320) 380-4539
                                </div>
                            </div> -->
                            <!-- <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    Bay Area, San Francisco, CA
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            Profile Settings
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <form class="form-horizontal" autocomplete="off" @submit.prevent="profileUpdate">
                                        <div class="form-group">
                                            <Label name="Name"/>
                                            <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}"
                                                placeholder="Enter New Name">
                                            <ErrorMessage :name="form.errors.name"/>
                                        </div>
                                        <div class="form-group">
                                            <Label name="Email"/>
                                            <input v-model="form.email" type="email"
                                                class="form-control " placeholder="Enter New Email" :class="{'is-invalid':form.errors.email}">
                                            <ErrorMessage :name="form.errors.email"/>
                                        </div>
                                        <div class="form-group">
                                            <Label name="Change Image" forName="change_image" :required="false"/>
                                            <div class="custom-file">
                                                <input accept="image/jpeg, image/jpg/ image/png"
                                                    @input="form.avatar = $event.target.files[0]" autocomplete="image"
                                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                    type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">
                                                    Choose file
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                                    <Loading v-if="form.processing"/>
                                                    <span v-else>
                                                        <i class="fa-solid fa-check mr-1"></i>
                                                        Update Profile
                                                    </span>
                                                </button>


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            Change Password
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <form class="form-horizontal" autocomplete="off" @submit.prevent="passwordUpdate">
                                        <div id="password_visibility">
                                            <div class="form-group">
                                                <Label name="Current Password"/>
                                                <input v-model="passwordForm.current_password" type="password"
                                                    class="form-control " placeholder="Enter Current Password" :class="{'is-invalid':passwordForm.errors.current_password}">
                                                    <ErrorMessage :name="passwordForm.errors.current_password"/>
                                            </div>
                                            <div class="form-group">
                                                <Label name="New Password"/>
                                                <input v-model="passwordForm.password" type="password" class="form-control "
                                                    placeholder="Enter New Password" :class="{'is-invalid':passwordForm.errors.password}">
                                                <ErrorMessage :name="passwordForm.errors.password"/>

                                            </div>
                                            <div class="form-group">
                                                <Label name="Confirm Password"/>
                                                <input v-model="passwordForm.password_confirmation" type="password"
                                                    class="form-control " placeholder="Confirm New Password" :class="{'is-invalid':passwordForm.errors.password_confirmation}">
                                                <ErrorMessage :name="passwordForm.errors.password_confirmation"/>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button :disabled="passwordForm.processing" type="submit" class="btn btn-primary">
                                                    <Loading v-if="passwordForm.processing"/>
                                                    <span v-else>
                                                        <i class="fa-solid fa-check mr-1"></i>
                                                        Update Password
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            preview_image: this.user.avatar,

            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                avatar: null,
            }),

            passwordForm: this.$inertia.form({
                current_password: "",
                password: "",
                password_confirmation: "",
            }),
        };
    },
    methods: {
        profileUpdate() {
            this.form.post(route("user.profile.update"));
        },
        passwordUpdate() {
            this.passwordForm.post(route("user.password.update"), {
                onSuccess: () => this.passwordForm.reset(),
            });
        },
    },
};
</script>

<style scoped>
#image {
    object-fit: cover;
}
</style>


