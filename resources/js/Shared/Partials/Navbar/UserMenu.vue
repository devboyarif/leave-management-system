<template>
    <li class="nav-item dropdown user-menu" :class="{'show':show}">
        <a href="#" class="nav-link dropdown-toggle" @click="show = !show" data-toggle="dropdown"
            aria-expanded="true">
            <img :src="$page.props.user.avatar"
                class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"> {{ $page.props.user.name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded border-0" :class="{'show':show}"
            style="left: inherit; right: 0px;">
            <!-- User image -->
            <li class="user-header bg-primary rounded-top">
                <img :src="$page.props.user.avatar"
                    class="user-image img-circle elevation-2" alt="User Image">
                <p>
                    {{ $page.props.user.name }}
                    <!-- <small>Member since Dec 21, 2021</small> -->
                </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer border-bottom d-flex">
                <Link :href="route('user.profile')" class="btn btn-default">
                    Profile
                </Link>
                <Link class="btn btn-default ml-auto" href="/logout" method="post" as="button">Logout</Link>
            </li>
        </ul>
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

