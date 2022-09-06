<template>
    <li class="nav-item dropdown show" v-click-outside="()=> show = false">
        <a v-tooltip="__('Notification')" class="nav-link" href="#" @click="showNotification">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge" v-if="unreadNotificationsCount">
                {{ unreadNotificationsCount }}
            </span>
        </a>
        <div v-show="show" class="dropdown-menu dropdown-menu-lg dropdown-menu-right show" style="left: inherit; right: 0px;">
            <template v-if="notifications.length">
                <a href="#" class="dropdown-item border-bottom" v-for="(notification, index) in notifications" :key="index">
                    <div class="media">
                        <div class="media-body" v-if="notification.data">
                            <h6 v-html="notification.data.message"></h6>
                            <p class="text-sm"><i class="far fa-clock mr-1"></i>
                            {{ timeFromNow(notification.created_at) }}
                            </p>
                        </div>
                    </div>
                </a>
            </template>
             <h6 class="text-center my-5" v-else>{{ __('No Data Found') }}</h6>
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
};
</script>

<style scoped>
.dropdown-menu-lg {
    max-height: 380px !important;
    max-width: 380px !important;
}
</style>
