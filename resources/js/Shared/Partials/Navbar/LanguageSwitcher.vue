<template>
    <li class="nav-item dropdown" :class="{'show':show}">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" @click="show = !show">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#1f2d3d" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 5h7"></path>
                <path d="M9 3v2c0 4.418 -2.239 8 -5 8"></path>
                <path d="M5 9c-.003 2.144 2.952 3.908 6.7 4"></path>
                <path d="M12 20l4 -9l4 9"></path>
                <path d="M19.1 18h-6.2"></path>
            </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;" :class="{'show':show}">
            <a class="dropdown-item " href="https://adlisting.zakirsoft.com/admin/language/changelanguage/default">
                English (default)
            </a>
            <a class="dropdown-item " href="https://adlisting.zakirsoft.com/admin/language/changelanguage/de">
                German
            </a>
            <a class="dropdown-item " href="https://adlisting.zakirsoft.com/admin/language/changelanguage/bn">
                Bengali
            </a>
            <a class="dropdown-item " href="https://adlisting.zakirsoft.com/admin/language/changelanguage/it">
                Italian
            </a>
            <a class="dropdown-item " href="https://adlisting.zakirsoft.com/admin/language/changelanguage/aa">
                Arabic
            </a>
        </div>
    </li>
</template>

<script>
export default {
    name: 'language-switcher',
    data() {
        return {
            show: false,
        }
    }
}
</script>

