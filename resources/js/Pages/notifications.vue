<template>

    <Head :title="__('All Notification')" />

    <div class="row justify-content-center pt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('All Notification') }}</div>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <template v-if="notifications.length">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" v-for="(notification, index) in notifications" :key="index">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ notification.data.message }}</h5>
                                    <small class="text-muted">
                                        {{ timeFromNow(notification.created_at) }}
                                    </small>
                                </div>
                            </a>
                        </template>
                        <h6 class="text-center" v-else>{{ __('No Data Found') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        notifications: Array,
    },
    data() {
        return {
            // currentTab: "all",
            // employees: this.employees,
        };
    },
    methods: {
        // async changeTab(tab) {
        //     this.currentTab = tab;
        //     let response = await axios.get(
        //         route("employee.teams.employees", {
        //             team: tab,
        //         })
        //     );
        //     this.employees = response.data.employees;
        // },
    },
};
</script>
