<template>
    <li class="nav-item dropdown show">
        <a @click="show = !show" v-click-outside="()=> show = false" class="nav-link d-inline-flex py-0 align-items-center" href="javascript:void(0)" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <div class="profile-details d-none d-lg-inline mr-1 text-right">
                <div class="mr-1 d-block font-weight-medium">{{ $page.props.authenticatedUser.name }}</div>
            </div>
            <img height="32" width="32" class="img-profile rounded-circle user-image elevation-2" :src="$page.props.authenticatedUser.avatar">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in lokalise-menu" :class="{'show':show}">
              <Link :href="route('user.profile')" class="dropdown-item" v-tooltip="'Profile'">
                <i class="fa-solid fa-user"></i>
                {{ __('Profile') }}
            </Link>
            <Link href="/logout" class="dropdown-item" method="post" v-tooltip="'Logout'">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('Logout') }}
            </Link>
        </div>
    </li>
</template>

<script>
import UserIcon from "../../Icons/UserIcon.vue";
import CogIcon from "../../Icons/CogIcon.vue";

export default {
    name: "user-menu",
    components: {
        UserIcon,
        CogIcon,
    },
    data() {
        return {
            show: false,
        };
    },
};
</script>
