<template>
    <li class="nav-item dropdown user-menu" :class="{'show':show}">
        <Link :href="route('user.profile')" class="nav-link">
            <img :src="$page.props.user.avatar"
                class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"> {{ $page.props.user.name }}</span>
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

