<template>
    <Head :title="__('Application')" />

      <div class="row pt-3 gutters-sm">
        <div class="col-md-4 d-none d-md-block">
          <div class="card">
            <div class="card-body">
              <nav class="nav flex-column nav-pills nav-gap-y-1">
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'profile'}" @click="changeTab('profile')">
                  <UserIcon class="mr-2"/>
                  {{ __('General') }}
                </a>
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'themes'}" @click="changeTab('themes')">
                  <PenIcon class="mr-2"/>
                  {{ __('Themes') }}
                    <template v-if="!hasAccessCustomThemeLook">
                        <span class="right badge badge-danger">{{ __('Pro') }}</span>
                    </template>
                </a>
                <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded" :class="{'active': currentTab == 'week_days'}" @click="changeTab('week_days')">
                  <CalendarIcon class="mr-2"/>
                  {{ __('Working Days') }}
                </a>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-md-8 tab-content">
            <div class="tab-pane fade" :class="{'show active': currentTab == 'profile'}">
                <General :user="user" :company="company" :countries="countries"/>
            </div>
            <div class="tab-pane fade" :class="{'show active': currentTab == 'themes'}">
                <Theme :theme="theme"/>
            </div>
            <div class="tab-pane fade" :class="{'show active': currentTab == 'week_days'}">
                <WorkingDays :workingdays="workingdays"/>
            </div>
        </div>
      </div>
</template>

<script>
import General from "../../Shared/Company/Setting/General.vue";
import Theme from "../../Shared/Company/Setting/Theme.vue";
import WorkingDays from "../../Shared/Company/Setting/WorkingDays.vue";
import UserIcon from "../../Shared/Icons/UserIcon.vue";
import PenIcon from "../../Shared/Icons/PenIcon.vue";
import CalendarIcon from "../../Shared/Icons/CalendarIcon.vue";

export default {
    props: {
        company: Object,
        user: Object,
        workingdays: Object,
        theme: Object,
        countries: Object,
    },
    components: {
        General,
        Theme,
        WorkingDays,
        UserIcon,
        PenIcon,
        CalendarIcon,
    },
    data() {
        return {
            currentTab: "profile",
            role: this.$page.props.authenticatedUser.role,
            subscription: this.$page.props.current_subscription,
        };
    },
    methods: {
        async changeTab(tab) {
            localStorage.setItem("companySettingTab", tab);
            this.currentTab = tab;
        },
    },
    computed: {
        hasAccessCustomThemeLook() {
            return (
                this.subscription.plan &&
                this.subscription.plan.plan_features &&
                this.subscription.plan.plan_features.custom_theme_look
            );
        },
    },
    mounted() {
        this.checkPagePermission("owner");
        let tab = localStorage.getItem("companySettingTab") || "profile";
        this.currentTab = tab;
        this.changeTab(tab);
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

.theme-bg-white {
    background-color: #fff !important;
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
