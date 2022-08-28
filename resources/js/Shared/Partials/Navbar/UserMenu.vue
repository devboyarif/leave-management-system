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
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in lokalise-menu " :class="{'show':show}"
            aria-labelledby="userDropdown">
            <Link class="dropdown-item" :href="route('user.profile')">{{ __('Profile') }}</Link>
            <Link class="dropdown-item" :href="route('company.settings.general')">{{ __('Settings') }}</Link>
                <a href="" class="dropdown-item"
                    target="_blank">Support</a>
                <a href="" class="dropdown-item bug-item"
                data-toggle="bug-dialog">Usage & Billing</a>
                 <Link href="/logout" method="post" class="dropdown-item logout-item">{{ __('Logout') }}</Link>
                <!-- <a href="" class="dropdown-item"
                target="_blank">Switch organization</a> -->
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="http://google.com">Switch organization</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Kodebazar</a></li>
                        <li><a class="dropdown-item" href="#">Templatecookie</a></li>
                    </ul>
                </li>
            <!-- <div class="border-top border-bottom my-2">
            </div>
             -->
             <!-- <br>
             <br> -->


        </div>
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

<style scoped>
.dropdown-menu  {
    width: 240px;
}













.navbar-nav li:hover > ul.dropdown-menu {
    display: block;
}
.dropdown-submenu {
    position:absolute;

    display: block;
    width: 100%;
    /* padding: 0.25 1rem; */
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left: -200px;
    margin-top:-6px;
    width: 200px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
}


</style>
