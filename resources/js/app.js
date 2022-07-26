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
import SettingLayout from "./Shared/Layout/Setting.vue";
import ErrorMessage from "./Shared/Forms/ErrorMessage.vue";
import Info from "./Shared/Forms/Info.vue";
import Label from "./Shared/Forms/Label.vue";
import Loading from "./Shared/Loading.vue";
import EditIcon from "./Shared/Icons/EditIcon.vue";
import EyeIcon from "./Shared/Icons/EyeIcon.vue";
import DeleteIcon from "./Shared/Icons/DeleteIcon.vue";
import CheckIcon from "./Shared/Icons/CheckIcon.vue";
import CrossIcon from "./Shared/Icons/CrossIcon.vue";
import CogIcon from "./Shared/Icons/CogIcon.vue";

// 3rd party plugins
import FloatingVue from 'floating-vue'
import 'floating-vue/dist/style.css'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Toaster from "@meforma/vue-toaster";
import vClickOutside from "click-outside-vue3"
import dayjs from 'dayjs';
import RelativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(RelativeTime);

const app = createApp({
    render: () => h(InertiaApp, {
        initialPage: data,
        resolveComponent: async name => {
            let page = (await import(`./Pages/${name}`)).default;

            if (page.layout === undefined) {
                page.layout = Layout;
            } else if (page.layout === 'Auth') {
                page.layout = AuthLayout;

            }else if (page.layout === 'Setting') {
                page.layout = SettingLayout;
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
    .mixin(require('./base'))
    .mixin({
        methods: {
            formateDate(date, format = 'MMMM D, YYYY') {
                return dayjs(date).format(format);
            },
            timeFromNow(date) {
                return dayjs(date).fromNow();
            },
        }
    })
    .component('Head', Head)
    .component('Link', Link)
    .component('ErrorMessage', ErrorMessage)
    .component('Info', Info)
    .component('Label', Label)
    .component('Loading', Loading)
    .component('EditIcon', EditIcon)
    .component('DeleteIcon', DeleteIcon)
    .component('EyeIcon', EyeIcon)
    .component('CogIcon', CogIcon)
    .component('CheckIcon', CheckIcon)
    .component('CrossIcon', CrossIcon)

    .mount(el);


InertiaProgress.init({
    color: 'red',
    delay: 500,
    includeCSS: true,
    showSpinner: true
})
