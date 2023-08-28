import "./bootstrap";
import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

const meta = document.createElement("meta");
meta.name = "naive-ui-style";
document.head.appendChild(meta);

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: false });
        return pages[`./Pages/${name}.vue`]();
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    title: (title) =>
        title
            ? `${title} - ${import.meta.env.VITE_APP_NAME}`
            : import.meta.env.VITE_APP_NAME,
});
