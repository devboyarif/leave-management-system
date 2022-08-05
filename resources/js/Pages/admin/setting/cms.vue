<template>
    <div class="row justify-content-center pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'home_page'}" @click="changeTab('home_page')">Home Page</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'about_page'}" @click="changeTab('about_page')">About Page</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'plan_page'}" @click="changeTab('plan_page')">Pricing Page</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'contact_page'}" @click="changeTab('contact_page')">Contact Page</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'terms_page'}" @click="changeTab('terms_page')">Terms & Condition Page</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'privacy_page'}" @click="changeTab('privacy_page')">Privacy Policy Page</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9">
                            <div class="border rounded">
                                <div class="tab-content no-padding">
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'home_page'}">
                                       <HomePage/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'about_page'}">
                                        <AboutPage/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'plan_page'}">
                                        <PlanPage/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'contact_page'}">
                                       <ContactPage/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'terms_page'}">
                                        <TermsPage/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'privacy_page'}">
                                        <PrivacyPage/>
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
import HomePage from '../../../Shared/Admin/Setting/Website/HomePage.vue';
import AboutPage from '../../../Shared/Admin/Setting/Website/AboutPage.vue';
import ContactPage from '../../../Shared/Admin/Setting/Website/ContactPage.vue';
import PlanPage from '../../../Shared/Admin/Setting/Website/PlanPage.vue';
import PrivacyPage from '../../../Shared/Admin/Setting/Website/PrivacyPage.vue';
import TermsPage from '../../../Shared/Admin/Setting/Website/TermsPage.vue';

export default {
    layout: "Setting",
    components: { HomePage, AboutPage, ContactPage, PlanPage, PrivacyPage, TermsPage },
    data() {
        return {
            currentTab: "home_page",
            paymentData: {},
        };
    },
    methods: {
        async changeTab(tab) {
            localStorage.setItem("cmsCurrentTab", tab);
            this.currentTab = tab;
            let response = await axios.get(route("settings.payment.data", {
                provider: tab,
            }));
            this.paymentData = response.data;
        }
    },
    mounted() {
        let tab = localStorage.getItem("cmsCurrentTab") || "home_page";
        this.currentTab = tab;
        this.changeTab(tab);
    },
};
</script>
