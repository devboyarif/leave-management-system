<template>

    <Head :title="__('Application')" />

    <div class="row pt-3 gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded"
                            :class="{'active': currentTab == 'brand_info'}" @click="changeTab('brand_info')">
                            <RingIcon class="mr-2" />
                            {{ __('Brand Information') }}
                        </a>
                        <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded"
                            :class="{'active': currentTab == 'social_media'}" @click="changeTab('social_media')">
                            <TwitterIcon class="mr-2" />
                            {{ __('Social Media') }}
                        </a>
                        <a href="javascript:void(0)" class="nav-item nav-link has-icon nav-link-faded"
                            :class="{'active': currentTab == 'sms'}" @click="changeTab('sms')">
                            <PhoneIcon class="mr-2" />
                            {{ __('SMS') }}
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class=" tab-content">
                <div class="tab-pane fade" :class="{'show active': currentTab == 'brand_info'}">
                    <BrandInfo :setting="setting" />
                </div>
                <div class="tab-pane fade" :class="{'show active': currentTab == 'social_media'}">
                    <SocialMedia :setting="setting" />
                </div>
                <div class="tab-pane fade" :class="{'show active': currentTab == 'sms'}">
                    <SMS :data="sms_settings"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BrandInfo from "../../../Shared/Admin/Setting/General/BrandInfo.vue";
import SocialMedia from "../../../Shared/Admin/Setting/General/SocialMedia.vue";
import SMS from "../../../Shared/Admin/Setting/General/SMS.vue";
import RingIcon from "../../../Shared/Icons/RingIcon.vue";
import TwitterIcon from "../../../Shared/Icons/TwitterIcon.vue";
import PhoneIcon from "../../../Shared/Icons/PhoneIcon.vue";

export default {
    layout: "Setting",
    props: {
        setting: Object,
        sms_settings: Object,
    },
    components: {
        BrandInfo,
        SocialMedia,
        RingIcon,
        TwitterIcon,
        PhoneIcon,
        SMS,
    },
    data() {
        return {
            currentTab: "brand_info",
        };
    },
    methods: {
        async changeTab(tab) {
            localStorage.setItem("generalCurrentTab", tab);
            this.currentTab = tab;
        },
    },
    mounted() {
        let tab = localStorage.getItem("generalCurrentTab") || "brand_info";
        this.currentTab = tab;
        this.changeTab(tab);
    },
};
</script>
