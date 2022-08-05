<template>
    <Link href="/">Home</Link> |
    <Link href="/about">About</Link> |
    <Link href="/contact">Contact</Link> |

    <Layout/>

    <h1>Hello World</h1>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Layout from '../Shared/Layout/Default.vue'

export default {
    components: {
        Link,
        Layout
    }
}
</script>
