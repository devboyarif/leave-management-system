<template>
    <Head :title="__('Payment')"/>

     <div class="row justify-content-center pt-5">
        <div class="col-12">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title line-height-36">{{ __('Payment Settings') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'paypal'}" @click="changeTab('paypal')">{{ __('Paypal') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'stripe'}" @click="changeTab('stripe')">{{ __('Stripe') }}</a>
                                </li>

                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'razorpay'}" @click="changeTab('razorpay')">{{ __('Razorpay') }}</a>
                                </li>

                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'flutterwave'}" @click="changeTab('flutterwave')">{{ __('Flutterwave') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'mollie'}" @click="changeTab('mollie')">{{ __('Mollie') }}</a>
                                </li>

                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'paystack'}" @click="changeTab('paystack')">{{ __('PayStack') }}</a>
                                </li>

                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'instamojo'}" @click="changeTab('instamojo')">{{ __('Instamojo') }}</a>
                                </li>
                                <li class="nav-item border rounded mb-1">
                                    <a href="javascript:void(0)" class="nav-link"  :class="{'active': currentTab == 'midtrans'}" @click="changeTab('midtrans')">{{ __('Midtrans') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9">
                            <div class="border rounded">
                                <div class="tab-content no-padding">
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'paypal'}">
                                        <Paypal :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'stripe'}">
                                       <Stripe :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'razorpay'}">
                                       <Razorpay :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'flutterwave'}">
                                       <Flutterwave :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'mollie'}">
                                       <Mollie :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'paystack'}">
                                       <Paystack :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'instamojo'}">
                                       <Instamojo :data="paymentData"/>
                                    </div>
                                    <div class="tab-pane fade" :class="{'show active': currentTab == 'midtrans'}">
                                       <Midtrans :data="paymentData"/>
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
import Paypal from "../../../Shared/Admin/Setting/Payment/Paypal.vue";
import Stripe from "../../../Shared/Admin/Setting/Payment/Stripe.vue";
import Razorpay from "../../../Shared/Admin/Setting/Payment/Razorpay.vue";
import Flutterwave from "../../../Shared/Admin/Setting/Payment/Flutterwave.vue";
import Mollie from "../../../Shared/Admin/Setting/Payment/Mollie.vue";
import Paystack from "../../../Shared/Admin/Setting/Payment/Paystack.vue";
import Instamojo from "../../../Shared/Admin/Setting/Payment/Instamojo.vue";
import Midtrans from "../../../Shared/Admin/Setting/Payment/Midtrans.vue";
export default {
    layout: "Setting",
    components: {
        Paypal,
        Stripe,
        Razorpay,
        Flutterwave,
        Mollie,
        Paystack,
        Instamojo,
        Midtrans,
    },
    data() {
        return {
            currentTab: "paypal",
            paymentData: {},
        };
    },
    methods: {
        async changeTab(tab) {
            localStorage.setItem("currentTab", tab);
            this.currentTab = tab;
            let response = await axios.get(
                route("settings.payment.data", {
                    provider: tab,
                })
            );

            this.paymentData = response.data;
        },
    },
    mounted() {
        let tab = localStorage.getItem("currentTab") || "paypal";
        this.currentTab = tab;
        this.changeTab(tab);
    },
};
</script>
