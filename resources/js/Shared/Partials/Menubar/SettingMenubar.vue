<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <Link :href="route('dashboard')" class="brand-link">
            <img :src="setting.app_favicon" alt="logo"
                class="brand-image img-circle">
            <span class="brand-text font-weight-bold">{{ setting.app_name }}</span>
        </Link>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                     <NavLink title="General" :href="route('settings.general')" :active="$page.component == 'admin/setting/general'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-gear nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Website CMS" :href="route('settings.cms')" :active="$page.component == 'admin/setting/cms'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-file-pen nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Language" :href="route('languages.index')" :active="$page.component == 'admin/setting/language/index' || $page.component == 'admin/setting/language/translation'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-language nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Currency" :href="route('settings.currency')" :active="$page.component == 'admin/setting/currency'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-dollar-sign nav-icon"></i>
                        </template>
                    </NavLink>
                    <NavLink title="Theme" :href="route('theme')" :active="$page.component == 'admin/setting/theme'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-language nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="SEO" :href="route('settings.seo')" :active="$page.component == 'admin/setting/seo'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-magnifying-glass nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="SMTP" :href="route('settings.smtp')" :active="$page.component == 'admin/setting/smtp'">
                        <template v-slot:icon>
                            <i class="fa-regular fa-envelope nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Payment Gateway" :href="route('settings.payment')" :active="$page.component == 'admin/setting/payment'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-credit-card nav-icon"></i>
                        </template>
                    </NavLink>
                     <NavLink title="Upgrade" :href="route('settings.upgrade')" :active="$page.component == 'admin/setting/upgrade'">
                        <template v-slot:icon>
                            <i class="fa-solid fa-upload nav-icon"></i>
                        </template>
                    </NavLink>

                     <li class="nav-item">
                        <Link href="/logout" class="nav-link" method="post">
                           <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                            <p>{{ __('Logout') }}</p>
                        </Link>
                    </li>
                    <NavLink title="Go Back" :href="route('dashboard')" :active="$page.component == 'dashboard'" class="bg-danger text-light mt-5">
                        <template v-slot:icon>
                           <i class="fa-solid fa-arrow-left nav-icon"></i>
                        </template>
                    </NavLink>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import NavLink from "./NavItem.vue";

export default {
    components: {
        NavLink,
    },
    data() {
        return {
            setting: this.$page.props.setting,
        };
    },
};
</script>

