<template>
    <li v-tooltip="'Profile'" class="nav-item dropdown user-menu" :class="{'show':show}">
        <Link :href="route('user.profile')" class="nav-link">
        <img :src="$page.props.authenticatedUser.avatar" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"> {{ $page.props.authenticatedUser.name }}</span>
        </Link>
    </li>
    <li class="nav-item dropdown show">
        <a class="nav-link d-inline-flex py-0 align-items-center" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <div class="profile-details d-none d-lg-inline mr-2 text-right">
                <div class="mr-2 d-block font-weight-medium" style="color: #3B4248;">Arif</div>
                <div class="mr-2 d-block" style="color: #475056;">Zakirsoft</div>
            </div>

            <img height="32" width="32" class="img-profile rounded-circle" src="https://desktime.com/shared/users/28/05/372805/1634354438.jpg">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in lokalise-menu show"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="https://desktime.com/app/profile">
                <i class="fa-solid fa-user"></i>
                Profile
            </a>
            <a class="dropdown-item" href="https://desktime.com/app/profile">
                <i class="fa-solid fa-gear"></i>
                Setting
            </a>
            <hr>
            <a class="dropdown-item logout-item" href="https://desktime.com/logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
            <form id="logout-form" action="https://desktime.com/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="9gSq1Td5sRF6OC4vUKUBJohg2rVdBKDeBuHwunNK">
            </form>
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
