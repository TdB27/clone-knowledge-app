import "./config/bootstrap";
import "font-awesome/css/font-awesome.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

import Toast, { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";

import store from "./config/store";
import { vuetify } from "./config/vuetify";

import "../css/app.css";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mixin({ data: () => ({ toast: useToast() }) })
            .use(useToast)
            .use(Toast)
            .use(store)
            .use(vuetify)
            .mount(el);
    },
});
