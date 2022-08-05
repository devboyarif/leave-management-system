<template>
    <li v-tooltip="'Profile'" class="nav-item dropdown user-menu" :class="{'show':show}">
        <Link :href="route('user.profile')" class="nav-link">
            <img :src="$page.props.authenticatedUser.avatar"
                class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"> {{ $page.props.authenticatedUser.name }}</span>
        </Link>
    </li>
</template>

<script>
export default {
    name: "user-menu",
    data() {
        return {
            show: false,
        };
    },
};
</script>

