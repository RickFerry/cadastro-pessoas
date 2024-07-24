import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(Vuetify)
            .mount(el);
    },
});
