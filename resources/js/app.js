import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

import Toast, { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";

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
            .mixin({ data: () => ({ toast: useToast() }) })
            .use(useToast)
            .use(Toast)
            .mount(el);
    },
});
