import './polyfills';
import Vue from 'vue';
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import { useModal } from './Utils/UseModal.js';

require('./bootstrap');

Vue.mixin({
    methods: {
        route,

        __ (key) {
            if (!this.$page?.props?.translations) {
                return key;
            }

            return this.$page.props.translations[key]
                ? this.$page.props.translations[key]
                : key;
        }
    }
});

Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    mixins: [useModal],
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
