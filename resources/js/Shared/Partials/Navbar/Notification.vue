<template>
    <li class="nav-item dropdown show" v-click-outside="()=> show = false">
        <a v-tooltip="__('Notification')" class="nav-link" href="#" @click="showNotification">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            <template v-if="role == 'owner'">
                <span class="badge badge-danger navbar-badge" v-if="unReadNotificationCount">
                    {{ unReadNotificationCount }}
                </span>
            </template>
            <template v-else>
                <span class="badge badge-danger navbar-badge" v-if="unreadNotificationsCount">
                    {{ unreadNotificationsCount }}
                </span>
            </template>
        </a>
        <div v-show="show" class="dropdown-menu dropdown-menu-lg dropdown-menu-right show">
            <template v-if="role != 'owner' && notifications.length">
                <a :href="notification.data.url" class="dropdown-item"
                    v-for="(notification, index) in notifications"
                    :key="index">
                    <div class="media">
                        <div class="media-body" v-if="notification.data">
                            <h6 v-html="notification.data.message"></h6>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                            {{ timeFromNow(notification.created_at) }}
                            </p>
                        </div>
                    </div>
                </a>
            </template>
            <template v-else-if="role == 'owner' && companyNotifications && companyNotifications.length">
                <a :href="notification.data.url" class="dropdown-item"
                    v-for="(notification, index) in companyNotifications"
                    :key="index">
                    <div class="media">
                        <div class="media-body" v-if="notification.data">
                            <h6 v-html="notification.data.message"></h6>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                            {{ timeFromNow(notification.created_at) }}
                            </p>
                        </div>
                    </div>
                </a>
            </template>
            <h6 class="text-center my-5" v-else>
                {{ __('No Data Found') }}
            </h6>
            <div class="dropdown-divider"></div>
            <Link :href="route('notifications.index')" class="dropdown-item dropdown-footer">
                {{ __('See All Notifications') }}
            </Link>
        </div>
    </li>
</template>

<script>
export default {
    data() {
        return {
            show: false,
            notifications: this.$page.props.notifications,
            unreadNotificationsCount: this.$page.props.unreadNotificationsCount,
            role: this.$page.props.authenticatedUser.role,
            currentCompany: this.$page.props.currentCompany,
        };
    },
    methods: {
        showNotification() {
            this.show = !this.show;
            if (this.unreadNotificationsCount) {
                axios.get(route("markasread.notifications"));

                this.unreadNotificationsCount = 0;
            }
        },
    },
    computed: {
        companyNotifications(){
            let totalNotifications = []

            if(this.role == 'owner'){
                this.notifications.find((notification) => {
                    if (notification.data.company_id == this.currentCompany.id) {
                        totalNotifications.push(notification)
                    }
                });

            }

            return totalNotifications
        },
        unReadNotificationCount(){
            let notificationCount = 0

            if(this.role == 'owner'){
                if(this.role == 'owner'){
                    this.notifications.find((notification) => {
                        if (notification.data.company_id == this.currentCompany.id && !notification.read_at) {
                            notificationCount++
                        }
                    });
                }
            }

            return notificationCount;
        }
    },
};
</script>

<style scoped>
.dropdown-menu-lg {
    max-height: 380px !important;
    max-width: 380px !important;
}
</style>
