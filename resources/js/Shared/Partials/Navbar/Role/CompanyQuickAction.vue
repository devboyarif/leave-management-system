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
                    <Link :href="route('company.employees.index')"
                        class="d-block text-center py-3 bg-hover-light">
                         <i class="fa-solid fa-user-tie"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Employee') }}</span>
                    </Link>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('company.leaveRequests.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-file-pen"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Leave Request') }}</span>
                    </Link>
                </div>
            </div>
            <div class="row row-paddingless">
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('company.leaveTypes.create')"
                        class="d-block text-center py-3 bg-hover-light">
                        <i class="fa-solid fa-list"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Leave Type') }}</span>
                    </Link>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <Link :href="route('company.teams.index')"
                        class="d-block text-center py-3 bg-hover-light">
                         <i class="fa-solid fa-people-group"></i>
                        <span class="w-100 d-block text-muted">{{ __('Create Team') }}</span>
                    </Link>
                </div>
                <div class="col-12 p-0 border-bottom border-right">
                    <a href="https://adlisting.zakirsoft.com/admin/settings/website"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">Setting</span>
                    </a>
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
