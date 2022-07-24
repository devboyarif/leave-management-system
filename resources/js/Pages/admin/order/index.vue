<template>
    <Head :title="__('Order List')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>{{ __('Order List') }}</span>
                    </div>
                </div>
                    <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('Company') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Plan') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="orders && orders.data.length">
                                <tr v-for="(order,index) in orders.data" :key="index">
                                    <td>#{{ order.order_id }}</td>
                                        <td v-if="order.company && order.company.user">
                                            <b>{{ order.company.user.name }} ({{ order.company.user.email }})</b>
                                        </td>
                                    <td>
                                        {{ order.currency_symbol }}&nbsp;{{ order.amount }}
                                    </td>
                                    <td class="text-capitalize">
                                        {{ order.payment_provider }}
                                    </td>
                                    <td v-if="order.plan">
                                        <b>{{ order.plan.name }}</b>
                                        /
                                        <small v-if="order.plan.interval != 'custom_days'">{{ order.plan.interval }}</small>
                                        <small v-else>{{ order.plan.custom_interval_days }} {{ __('Days') }}</small>
                                    </td>
                                    <td class="d-flex">
                                        <button @click="showDetails(order)" v-tooltip="'Order Details'" class="btn btn-sm pl-0">
                                            <EyeIcon/>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td colspan="5" class="text-center">
                                    <h6>{{ __('No Data Found') }}</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination  -->
                    <Pagination :links="orders.links" />
                </div>
            </div>
        </div>
    </div>

     <!-- Details Holiday Modal  -->
    <div v-if="showModal">
        <transition name="fade">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" v-click-outside="()=> showModal = false">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    {{ __('Order Details') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="40%">{{ __('Order ID') }}</td>
                                            <td width="70%">
                                                #{{ form.order_id }}
                                            </td>
                                        </tr>
                                        <tr v-if="form.transaction_id">
                                            <td width="40%">{{ __('Transaction ID') }}</td>
                                            <td width="70%">
                                                {{ form.transaction_id }}
                                            </td>
                                        </tr>
                                         <tr v-if="form.company && form.company.user">
                                            <td width="40%">{{ __('Company') }}</td>
                                            <td width="60%">
                                                <b>{{ form.company.user.name }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Payment Method') }}</td>
                                            <td width="60%" class="text-capitalize">
                                                {{ form.payment_method }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Amount') }}</td>
                                            <td width="60%">
                                               {{ form.currency_symbol }}&nbsp;{{ form.amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Plan Name') }}</td>
                                            <td width="60%">
                                              {{ form.plan.name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Plan Type') }}</td>
                                            <td width="60%" class="text-capitalize">
                                              {{ form.plan.type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">{{ __('Subscription Type') }}</td>
                                            <td width="60%" class="text-capitalize">
                                              {{ form.plan.interval }}
                                            </td>
                                        </tr>
                                        <tr v-if="form.plan.interval == 'custom_days'">
                                            <td width="40%">{{ __('Custom Days') }}</td>
                                            <td width="60%">
                                              {{ form.plan.custom_interval_days }} {{ __('Days') }}
                                            </td>
                                        </tr>
                                        <tr v-if="form.plan.plan_features">
                                            <td width="40%">{{ __('Plan Features') }}</td>
                                            <td width="60%">
                                               <Feature name="Unlimited Employees" :checked="!form.plan.plan_features.is_limited_employee"/>
                                                <Feature name="Max Employees" :checked="true" :value="form.plan.plan_features.is_limited_employee ? form.plan.plan_features.max_employees : '∞'"/>
                                                <Feature name="Max Teams" :checked="true" :value="form.plan.plan_features.max_teams"/>
                                                <Feature name="Max Leave Types" :checked="true" :value="form.plan.plan_features.max_leave_types"/>
                                                <Feature name="Custom Theme Look" :checked="form.plan.plan_features.custom_theme_look"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    @click="showModal = false">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>


<script>
import Pagination from "../../../Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";
import Feature from "../../../Shared/Admin/Plan/Feature.vue";

export default {
    props: {
        orders: Array,
    },
    components: {
        Inertia,
        Pagination,
        Feature,
    },
    data() {
        return {
            showModal: false,
            form: {
                order_id: "",
                payment_method: "",
                amount: "",
                currency_symbol: "",
                plan: {},
            },
        };
    },
    methods: {
        showDetails(order) {
            this.form.order_id = order.order_id;
            this.form.payment_method = order.payment_provider;
            this.form.amount = order.amount;
            this.form.currency_symbol = order.currency_symbol;
            this.form.plan = order.plan;
            this.form.company = order.company;
            this.showModal = true;
        },
    },
};
</script>

<style scoped>
.modal-content {
    width: 750px !important;
}
</style>
