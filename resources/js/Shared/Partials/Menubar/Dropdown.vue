<template>
    <li class="nav-item" :class="{' menu-open': menuOpen}">
        <a href="#" class="nav-link" :class="{'active':active}" @click="menuOpen = !menuOpen">
            <slot name="icon"/>
            <p>
                {{ __(title) }}
                <IconChevronLeft classes="right" height="20" width="20" v-if="!menuOpen" />
                <IconChevronUp classes="right" height="20" width="20" v-else />
            </p>
        </a>
        <ul class="nav nav-treeview">
            <slot />
        </ul>
    </li>



</template>

<script>
import { directive } from "vue3-click-away";
import IconChevronUp from "../../Icons/ChevronUpIcon.vue";
import IconChevronLeft from "../../Icons/ChevronLeftIcon.vue";

export default {
    directives: {
        ClickAway: directive,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
        active: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        IconChevronUp,
        IconChevronLeft,
    },
    data() {
        return {
            menuOpen: false,
        };
    },
    methods: {
        away() {
            this.menuOpen = false;
        },
    },
};
</script>

