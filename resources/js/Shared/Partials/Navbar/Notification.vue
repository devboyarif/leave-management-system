<template>
    <li class="nav-item dropdown show" v-click-outside="()=> showNotification = false">
        <a v-tooltip="'Notification'" class="nav-link" href="#" @click="showNotification = !showNotification">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge">
                {{ unreadNotificationsCount }}
            </span>
        </a>
        <div v-show="showNotification" class="dropdown-menu dropdown-menu-lg dropdown-menu-right show" style="left: inherit; right: 0px;">
            <template v-if="notifications.length">
                <a href="#" class="dropdown-item" v-for="(notification, index) in notifications" :key="index">
                    <div class="media">
                        <div class="media-body" v-if="notification.data">
                            <p class="text-sm">{{ notification.data.message }}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
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
            showNotification: false,
            notifications: this.$page.props.notifications,
            unreadNotificationsCount: this.$page.props.unreadNotificationsCount,
        };
    },
};
</script>

<style scoped>
.dropdown-menu-lg {
    max-height: 380px !important;
    max-width: 380px !important;
}
</style>
