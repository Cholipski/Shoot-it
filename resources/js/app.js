require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-vue3';
import UUID from "vue-uuid";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default;

        page.layout ??= Layout;

        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin, UUID)
            .component('Head',Head)
            .mixin({
                mounted() {
                    window.addEventListener('popstate', ()=> {
                        this.$page.props.flash.popstate = true;
                    })
                },
                methods: {
                route,
                hasAnyPermission: function (permission) {
                    let allPermissions = this.$page.props.auth.can;
                    let hasPermission = false;
                    permission.forEach(function (item){
                        if(allPermissions[item]) hasPermission = true;
                    });
                    return hasPermission;
                }
            } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
