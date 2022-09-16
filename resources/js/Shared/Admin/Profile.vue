<template>
    <div class="container-fluid pt-3">
      <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'profile'}" @click="changeTab('profile')">
                  <UserIcon class="mr-2"/>
                  {{ __('Profile Information') }}
                </a>
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'account_setting'}" @click="changeTab('account_setting')">
                    <CogIcon class="mr-2"/>
                 {{ __('Account Settings') }}
                </a>
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'security'}" @click="changeTab('security')">
                    <GuardIcon class="mr-2"/>
                 {{ __('Security') }}
                </a>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-body tab-content">
                <div class="tab-pane fade" :class="{'show active': currentTab == 'profile'}">
                    <h6>{{ __('Profile Information') }}</h6>
                    <hr>
                     <form class="form-horizontal" autocomplete="off" @submit.prevent="profileUpdate">
                        <div class="form-group position-relative">
                            <Label :name="__('Avatar')"/>
                            <img :src="previewImage" alt="image" class="d-block ui-w-100 rounded-circle" id="image">
                            <div class="profile-edit font-weight-bold" v-tooltip="__('Edit')">
                                <a href="" @click.prevent="$refs.profileimage.click()">
                                    <svg aria-hidden="true" height="26" viewBox="0 0 16 16" version="1.1" width="26" data-view-component="true" class="octicon octicon-pencil">
                                        <path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path>
                                    </svg>
                                </a>
                            </div>
                            <input type="file" ref="profileimage" hidden accept="image/jpeg, image/jpg/ image/png"
                            @input="form.avatar = $event.target.files[0]" autocomplete="image"
                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="form-group">
                            <Label :name="__('Name')"/>
                            <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}"
                                placeholder="Enter New Name">
                            <ErrorMessage :name="form.errors.name"/>
                        </div>
                        <div class="form-group">
                            <Label :name="__('Email')"/>
                            <input v-model="form.email" type="email"
                                class="form-control " placeholder="Enter New Email" :class="{'is-invalid':form.errors.email}">
                            <ErrorMessage :name="form.errors.email"/>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                {{ __('Update Profile') }}
                            </span>
                        </button>
                    </form>
                </div>
                <div class="tab-pane fade" :class="{'show active': currentTab == 'account_setting'}">
                    <h6>{{ __('Account Settings') }}</h6>
                    <hr>
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
                        <button :disabled="passwordForm.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="passwordForm.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                {{ __('Update Password') }}
                            </span>
                        </button>
                    </form>
                </div>
                <div class="tab-pane fade" :class="{'show active': currentTab == 'security'}">
                    <h6>{{ __('Security') }}</h6>
                    <hr>
                    <div class="form-group">
                        <label class="d-block text-danger">{{ __('Delete Account') }}</label>
                        <p class="text-muted font-size-sm">{{ __('Once you delete your account, there is no going back. Please be certain') }}</p>
                    </div>
                    <button @click="deleteAccount" class="btn btn-danger" type="button">{{ __('Delete Account') }}</button>
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</template>

<script>
import UserIcon from "../Icons/UserIcon.vue";
import CogIcon from "../Icons/CogIcon.vue";
import GuardIcon from "../Icons/GuardIcon.vue";
import NotificationIcon from "../Icons/NotificationIcon.vue";
import CardIcon from "../Icons/CardIcon.vue";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    components: {
        UserIcon,
        CogIcon,
        GuardIcon,
        NotificationIcon,
        CardIcon,
    },
    data() {
        return {
            currentTab: "profile",

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

            previewImage: this.user.avatar,
        };
    },
    methods: {
        async changeTab(tab) {
            this.currentTab = tab;
        },
        profileUpdate() {
            this.form.post(route("user.profile.update"));
        },
        passwordUpdate() {
            this.passwordForm.post(route("user.password.update"), {
                onSuccess: () => this.passwordForm.reset(),
            });
        },
        deleteAccount() {
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
                    this.$inertia.delete(route("user.account.delete"));
                }
            });
        },
    },
};
</script>

<style scoped>
.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}




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
