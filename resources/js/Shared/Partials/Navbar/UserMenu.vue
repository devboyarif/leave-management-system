<template>
    <li class="nav-item dropdown show">
        <a @click="show = !show" v-click-outside="()=> show = false" class="nav-link d-inline-flex py-0 align-items-center" href="javascript:void(0)" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <div class="profile-details d-none d-lg-inline mr-1 text-right">
                <div class="mr-1 d-block font-weight-medium">
                    <template v-if="role == 'owner'">
                        <b>{{ currentCompany.company_name }}</b>
                        <p>{{ currentCompany.company_email }}</p>
                    </template>
                    <template v-else-if="role == 'employee'">
                        <b>{{ $page.props.authenticatedUser.name }}</b>
                        <p>{{ $page.props.employeeCompany.company_name }}</p>
                    </template>
                    <b v-else>{{ $page.props.authenticatedUser.name }}</b>
                </div>
            </div>
            <img height="32" width="32" class="img-profile rounded-circle user-image elevation-2" :src="role == 'owner' ? currentCompany.company_logo: $page.props.authenticatedUser.avatar">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in lokalise-menu font-weight-bold" :class="{'show':show}"
            aria-labelledby="userDropdown">
            <Link class="dropdown-item" :href="route('user.profile')">{{ __('Profile') }}</Link>
            <template v-if="role == 'owner'">
                <Link class="dropdown-item" :href="route('company.settings.general')">{{ __('Settings') }}</Link>
                <Link :href="route('company.billing')" class="dropdown-item bug-item"
                data-toggle="bug-dialog">{{ __('Usage & Billing') }}</Link>
                <li class="dropdown-submenu" >
                    <a class="dropdown-item dropdown-toggle" href="http://google.com">{{ __('Switch Company') }}</a>
                    <ul class="dropdown-menu">
                        <template v-if="ownerCompanies && ownerCompanies.length">
                            <li v-for="ownerCompany in ownerCompanies" :key="ownerCompany.id">
                                <a @click.prevent="switchCompany(ownerCompany.id)" href="javascript:void(0)" class="dropdown-item">
                                    <img :src="ownerCompany.company_logo" alt="img" class="switch-company-img mr-2">
                                   <b v-if="currentCompany.id == ownerCompany.id">{{ ownerCompany.company_name }}</b>
                                   <template v-else>{{ ownerCompany.company_name }}</template>
                                </a>
                            </li>
                        </template>
                        <hr>
                        <li>
                            <Link :href="route('company.create')" class="dropdown-item">
                                <b>{{ __('Create Company') }}</b>
                            </Link>
                        </li>
                    </ul>
                </li>
            </template>
            <Link href="/logout" method="post" class="dropdown-item logout-item">{{ __('Logout') }}</Link>
        </div>
    </li>
</template>

<script>
export default {
    name: "user-menu",
    data() {
        return {
            show: false,
            role: this.$page.props.authenticatedUser.role,
            currentCompany: this.$page.props.currentCompany,
            ownerCompanies: this.$page.props.ownerCompanies,

        };
    },
    methods:{
        async switchCompany(id) {
            await this.$inertia.post(route('company.switch', id), null,{
                onSuccess: () => {
                    window.location.reload()
                }
            })
        }
    }
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
    left: -250px;
    margin-top:-6px;
    width: 250px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
}

.switch-company-img {
    height: 25px;
    width: 25px;
    object-fit: cover;
}

</style>
