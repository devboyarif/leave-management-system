<template>
    <Head :title="__('Application')" />

 <div class="row justify-content-center pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'brand_info'}" @click="changeTab('brand_info')">Brand Information</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'social_media'}" @click="changeTab('social_media')">Social Media</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9">
                            <div class="border rounded">
                                <div class="tab-content no-padding">
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'brand_info'}">
                                       <BrandInfo :setting="setting"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'social_media'}">
                                       <SocialMedia :setting="setting"/>
                                    </div>
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
import BrandInfo from '../../../Shared/Admin/Setting/General/BrandInfo.vue'
import SocialMedia from '../../../Shared/Admin/Setting/General/SocialMedia.vue'

export default {
    layout: "Setting",
    props:{
        setting: Object
    },
    components: { BrandInfo, SocialMedia },
    data() {
        return {
            currentTab: 'brand_info'
        }
    },
     methods: {
        async changeTab(tab) {
            localStorage.setItem("generalCurrentTab", tab);
            this.currentTab = tab;
            // let response = await axios.get(route("settings.payment.data", {
            //     provider: tab,
            // }));
            // this.paymentData = response.data;
        }
    },
    mounted() {
        let tab = localStorage.getItem("generalCurrentTab") || "brand_info";
        this.currentTab = tab;
        this.changeTab(tab);
    },
}
</script>
