<template>
    <div class="row justify-content-center pt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'home_page'}" @click="changeTab('home_page')">{{ __('Home Page') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'about_page'}" @click="changeTab('about_page')">{{ __('About Page') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'plan_page'}" @click="changeTab('plan_page')">{{ __('Pricing Page') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'contact_page'}" @click="changeTab('contact_page')">{{ __('Contact Page') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'testimonial_section'}" @click="changeTab('testimonial_section')">{{ __('Testimonial Section') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'faq_section'}" @click="changeTab('faq_section')">{{ __('FAQ Section') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'terms_page'}" @click="changeTab('terms_page')">{{ __('Terms & Condition Page') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'privacy_page'}" @click="changeTab('privacy_page')">{{ __('Privacy Policy Page') }}</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9">
                            <div class="border rounded">
                                <div class="tab-content no-padding">
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'home_page'}">
                                       <HomePage :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'about_page'}">
                                        <AboutPage :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'plan_page'}">
                                        <PlanPage :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'contact_page'}">
                                       <ContactPage :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'testimonial_section'}">
                                       <TestimonialSection :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'faq_section'}">
                                       <FaqSection :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'terms_page'}">
                                        <TermsPage :cms="cms"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'privacy_page'}">
                                        <PrivacyPage :cms="cms"/>
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
import FaqSection from '../../../Shared/Admin/Setting/Website/FaqSection.vue';
import TestimonialSection from '../../../Shared/Admin/Setting/Website/TestimonialSection.vue';
import PlanPage from '../../../Shared/Admin/Setting/Website/PlanPage.vue';
import PrivacyPage from '../../../Shared/Admin/Setting/Website/PrivacyPage.vue';
import TermsPage from '../../../Shared/Admin/Setting/Website/TermsPage.vue';

export default {
    layout: "Setting",
    components: { HomePage, AboutPage, ContactPage, PlanPage, PrivacyPage, TermsPage,FaqSection, TestimonialSection },
    props: {
        cms: Object
    },
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
