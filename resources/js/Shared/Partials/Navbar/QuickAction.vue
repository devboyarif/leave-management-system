<template>
    <li class="nav-item dropdown" :class="{'show':show}">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" @click="show = !show">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" :class="{'show':show}" style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">Quick Actions</span>
            <div class="dropdown-divider"></div>
            <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="https://adlisting.zakirsoft.com/admin/user/create"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-users"></i>
                        <span class="w-100 d-block text-muted">Add User</span>
                    </a>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="https://adlisting.zakirsoft.com/admin/role/create"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-lock"></i>
                        <span class="w-100 d-block text-muted">Add Role</span>
                    </a>
                </div>
            </div>
            <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="https://adlisting.zakirsoft.com/admin/category/add"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-tags"></i>
                        <span class="w-100 d-block text-muted">Add Category</span>
                    </a>
                </div>
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="https://adlisting.zakirsoft.com/admin/skins"
                        class="d-block text-center py-3 bg-hover-light"> <i class="fas fa-adjust"></i>
                        <span class="w-100 d-block text-muted">Change Skin</span>
                    </a>
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
    name: 'quick-action',
    data() {
        return {
            show: false,
        }
    }
}
</script>
