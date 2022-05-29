require('./bootstrap');

import {
    createApp,
    h
} from 'vue';

import {
    App as InertiaApp,
    plugin as InertiaPlugin,
    Head,
    Link
} from '@inertiajs/inertia-vue3';

import {
    InertiaProgress
} from '@inertiajs/progress';

const el = document.getElementById('app');
const data = JSON.parse(el.dataset.page);

import Layout from "./Shared/Layout/Default.vue";
import AuthLayout from "./Shared/Layout/Auth.vue";
import ErrorMessage from "./Shared/Forms/ErrorMessage.vue";
import Label from "./Shared/Forms/Label.vue";
import Loading from "./Shared/Loading.vue";


const app = createApp({
    render: () => h(InertiaApp, {
        initialPage: data,
        resolveComponent: async name => {
            let page = (await import(`./Pages/${name}`)).default;

            if (page.layout === undefined) {
                page.layout = Layout;
            } else if (page.layout === 'Auth') {
                page.layout = AuthLayout;

            }

            console.log(page.layout);

            return page
        },
    })
});

app.use(InertiaPlugin)
    .mixin({
        methods: {
            route: window.route
        }
    })
    .component('Head', Head)
    .component('Link', Link)
    .component('ErrorMessage', ErrorMessage)
    .component('Label', Label)
    .component('Loading', Loading)

    .mount(el);


InertiaProgress.init({
    color: 'red',
    delay: 500,
    showSpinner: true
})
