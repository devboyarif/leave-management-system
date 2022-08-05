<template>
    <nav>
        <ul class="pagination justify-content-center">
            <template v-for="(link,index) in links">
                <template v-if="link.url">
                    <li class="page-item" :class="{'active':link.active}" :key="index">
                        <Link class="page-link d-inline" :href="link.url" v-html="link.label" />
                    </li>
                </template>
                <template v-else>
                    <li class="page-item disabled" :key="index" style="margin-top:-7px">
                        <a class="page-link" href="#" v-html="link.label" />
                    </li>
                </template>
            </template>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true,
        },
    },
};
</script>
