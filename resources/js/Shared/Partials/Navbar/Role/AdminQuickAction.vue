<template>
        <li class="nav-item dropdown" :class="{'show':show}" v-click-outside="()=> show = false">
        <a v-tooltip="'Quick Action'" class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" @click="show = !show">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" :class="{'show':show}">
            <span class="dropdown-item dropdown-header">{{ __('Quick Actions') }}</span>
            <div class="dropdown-divider"></div>
            <div class="row row-paddingless">
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('plans.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-credit-card"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Plan') }}</span>
                    </Link>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('leaveRequests.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-file-pen"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Leave Request') }}</span>
                    </Link>
                </div>
            </div>
            <div class="row row-paddingless">
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('companies.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-building-user "></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Company') }}</span>
                    </Link>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('employees.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Employee') }}</span>
                    </Link>
                </div>
                <div class="col-12 p-0 border-bottom border-right">
                    <Link :href="route('settings.general')"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">{{ __('Settings') }}</span>
                    </Link>
                </div>
            </div>
            <div class="dropdown-divider"></div>
        </div>
    </li>
</template>

<script>
export default {
    data() {
        return {
            show: false,
        };
    },
};
</script>
