<template>
    <Head :title="__('Order Details')"/>

    <div class="row p-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5>{{ __('Order Id') }}: <b>#{{ order.order_id }}</b></h5>
                            <h5>{{ __('Transaction ID') }}: <b>{{ order.transaction_id }}</b></h5>
                            <p class="">
                                {{ formateDate(order.created_at, 'MMMM D, YYYY, HH:mm') }} <br>
                            </p>
                        </div>
                        <div>
                            <a :href="route('orders.pdf.download', order.id)" target="_blank">
                                <b>
                                    <i class="fas fa-download"></i>
                                    {{ __('Download Invoice') }}
                                </b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <h5 class="mb-3">{{ __('Bill From') }}</h5>
                            <h6 class="mb-2" v-if="setting.app_name">{{ setting.app_name }}</h6>
                            <p class="mb-1" v-if="setting.app_contact_number">{{ setting.app_contact_number }}</p>
                            <p class="mb-0" v-if="setting.app_email"><a :href="`mailto:${setting.app_email}`">{{ setting.app_email }}</a></p>
                            <p class="mb-0" v-if="setting.app_location"><small>{{ setting.app_location }}</small></p>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <h5 class="mb-3">{{ __('Bill To') }}</h5>
                            <h6 class="mb-2" v-if="company.user">
                                {{ company.user.name }}
                            </h6>
                            <h6 class="mb-2" v-if="company.user"><a :href="`mailto:${company.user.email}`">{{ company.user.email }}</a></h6>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                            <h5 class="mb-3">{{ __('Company Details') }}</h5>
                            <h6 class="mb-2" v-if="company.company_name">{{ company.company_name }}</h6>
                            <p class="mb-1" v-if="company.company_phone">{{ company.company_phone }}</p>
                            <p class="mb-0" v-if="company.company_email"><a :href="`mailto:${company.company_email}`">{{ company.company_email }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Payment Details') }}</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-1">
                            <h6 class="mb-0 text-capitalize">
                                {{ __('Payment Method') }}: <b>{{ order.payment_provider }}</b>
                            </h6>
                            <p class="mb-0">
                                {{ __('Status') }}:
                                <span class="badge badge-pill badge-success" v-if="order.payment_status == 'paid'">
                                    {{ __('Paid') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('Plan Details') }}</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap col-12">
                        <table class="table">
                            <tbody>
                                <tr v-if="subscribed_plan.plan">
                                    <th>{{ __('Plan') }}</th>
                                    <td>{{ subscribed_plan.plan.name }}</td>
                                </tr>
                                <tr v-if="subscribed_plan.plan">
                                    <th>{{ __('Price') }}</th>
                                    <td>{{ currencyPosition(subscribed_plan.plan.price) }}</td>
                                </tr>
                                <tr v-if="subscribed_plan.plan">
                                    <th>{{ __('Subscription Type') }}</th>
                                    <td>
                                        <span v-if="subscribed_plan.plan.interval == 'custom_days'">
                                        {{ subscribed_plan.plan.custom_interval_days }} {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                        </span>
                                        <span v-else class="text-capitalize">{{ subscribed_plan.plan.interval }}</span>
                                    </td>
                                </tr>
                                <tr v-if="subscribed_plan.plan && subscribed_plan.plan.interval != 'lifetime'">
                                   <th>{{ __('Expiration Remaining') }}</th>
                                    <td>{{ subscribed_plan.remaining_days }}
                                    <span v-if="subscribed_plan.remaining_days != 'Lifetime'">
                                        {{ pluralize(subscribed_plan.remaining_days, 'Day') }}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                   <th width="40%">{{ __('Plan Features') }}</th>
                                    <td>
                                        <Feature :span-text="true" name="Unlimited Employees" :checked="!subscribed_plan.plan.plan_features.is_limited_employee"/>
                                        <Feature :span-text="true" name="Max Employees" :checked="true" :value="subscribed_plan.plan.plan_features.is_limited_employee ? subscribed_plan.plan.plan_features.max_employees : '∞'"/>
                                        <Feature :span-text="true" name="Max Teams" :checked="true" :value="subscribed_plan.plan.plan_features.max_teams"/>
                                        <Feature :span-text="true" name="Max Leave Types" :checked="true" :value="subscribed_plan.plan.plan_features.max_leave_types"/>
                                        <Feature :span-text="true" name="Custom Theme Look" :checked="subscribed_plan.plan.plan_features.custom_theme_look"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Feature from "../../../Shared/Admin/Plan/Feature.vue";

export default {
    props: {
        setting: Object,
        subscribed_plan: Object,
        order: Object,
        company: Object
    },
    components: {
        Feature
    }
}
</script>
