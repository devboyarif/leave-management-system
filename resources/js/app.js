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
import EyeIcon from "./Shared/Icons/EyeIcon.vue";
import DeleteIcon from "./Shared/Icons/DeleteIcon.vue";
import CheckIcon from "./Shared/Icons/CheckIcon.vue";
import CrossIcon from "./Shared/Icons/CrossIcon.vue";

// 3rd party plugins
import FloatingVue from 'floating-vue'
import 'floating-vue/dist/style.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toaster from "@meforma/vue-toaster";
import vClickOutside from "click-outside-vue3"

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
app.use(vClickOutside)
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
            },
            pluralize(val, word, plural = word + "s") {
                const _pluralize = (num, word, plural = word + "s") => [1, -1].includes(Number(num)) ? word : plural;
                if (typeof val === "object")
                    return (num, word) => _pluralize(num, word, val[word]);
                return _pluralize(val, word, plural);
            }
        },
        computed: {
            pageFlashes() {
                return this.$page.props.flash
            }
        },
    })
    .mixin(require('./base'))
    .component('Head', Head)
    .component('Link', Link)
    .component('ErrorMessage', ErrorMessage)
    .component('Label', Label)
    .component('Loading', Loading)
    .component('EditIcon', EditIcon)
    .component('DeleteIcon', DeleteIcon)
    .component('EyeIcon', EyeIcon)
    .component('CheckIcon', CheckIcon)
    .component('CrossIcon', CrossIcon)

    .mount(el);


InertiaProgress.init({
    color: 'red',
    delay: 500,
    includeCSS: true,
    showSpinner: true
})
