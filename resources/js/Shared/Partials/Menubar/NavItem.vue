<template>
    <li class="nav-item">
         <Link :href="href" class="nav-link" :class="{'active':active}">
            <slot name="icon"/>
            <p>
                {{ __(title) }}
            </p>
            <slot name="badge"/>
        </Link>
    </li>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        href: {
            type: String,
            required: true,
        },
        active: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
