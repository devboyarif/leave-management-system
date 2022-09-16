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
                        <template v-if="role != 'owner' && notifications.length">
                            <a :href="notification.data.url" class="list-group-item list-group-item-action flex-column align-items-start" v-for="(notification, index) in notifications" :key="index">
                                <div class="d-flex w-100 justify-content-between" v-if="notification.data">
                                    <h5 v-html="notification.data.message" class="mb-1"></h5>
                                    <small class="text-muted">
                                        {{ timeFromNow(notification.created_at) }}
                                    </small>
                                </div>
                            </a>
                        </template>
                        <template v-else-if="role == 'owner' && companyNotifications && companyNotifications.length">
                            <a :href="notification.data.url" class="list-group-item list-group-item-action flex-column align-items-start" v-for="(notification, index) in companyNotifications" :key="index">
                                <div class="d-flex w-100 justify-content-between" v-if="notification.data">
                                    <h5 v-html="notification.data.message" class="mb-1"></h5>
                                    <small class="text-muted">
                                        {{ timeFromNow(notification.created_at) }}
                                    </small>
                                </div>
                            </a>
                        </template>
                        <h6 class="text-center my-5" v-else>
                            {{ __('No Data Found') }}
                        </h6>
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
                role: this.$page.props.authenticatedUser.role,
                currentCompany: this.$page.props.currentCompany,
            }
        },
        computed: {
            companyNotifications() {
                let totalNotifications = []

                if (this.role == 'owner') {
                    this.notifications.find((notification) => {
                        if (notification.data.company_id == this.currentCompany.id) {
                            totalNotifications.push(notification)
                        }
                    });

                }

                return totalNotifications
            },
            unReadNotificationCount() {
                let notificationCount = 0

                if (this.role == 'owner') {
                    if (this.role == 'owner') {
                        this.notifications.find((notification) => {
                            if (notification.data.company_id == this.currentCompany.id && !notification
                                .read_at) {
                                notificationCount++
                            }
                        });
                    }
                }

                return notificationCount;
            }
        }
    };
</script>
