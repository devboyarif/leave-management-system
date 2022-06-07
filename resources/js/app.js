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

// Made components available globally
import Layout from "./Shared/Layout/Default.vue";
import AuthLayout from "./Shared/Layout/Auth.vue";
import ErrorMessage from "./Shared/Forms/ErrorMessage.vue";
import Label from "./Shared/Forms/Label.vue";
import Loading from "./Shared/Loading.vue";
import EditIcon from "./Shared/Icons/EditIcon.vue";
import DeleteIcon from "./Shared/Icons/DeleteIcon.vue";

// 3rd party plugins
import FloatingVue from 'floating-vue'
import 'floating-vue/dist/style.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toaster from "@meforma/vue-toaster";

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

// 3rd party plugins
app.use(FloatingVue)
app.use(VueSweetalert2);
app.use(Toaster, {
    position: 'top-right',
    duration: 5000,
})

app.use(InertiaPlugin)
    .mixin({
        methods: {
            route: window.route,
            toastSuccess(message = 'Action completed successfully') {
                this.$toast.success(message);
            },
            toastError(message = 'Something went wrong') {
                this.$toast.error(message);
            },
            toastWarning(message = 'Something went wrong') {
                this.$toast.warning(message);
            }
        },
        computed: {
            pageFlashes() {
                return this.$page.props.flash
            }
        },
    })
    .component('Head', Head)
    .component('Link', Link)
    .component('ErrorMessage', ErrorMessage)
    .component('Label', Label)
    .component('Loading', Loading)
    .component('EditIcon', EditIcon)
    .component('DeleteIcon', DeleteIcon)

    .mount(el);


InertiaProgress.init({
    color: 'red',
    delay: 500,
    showSpinner: true
})
