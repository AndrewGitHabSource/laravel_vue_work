import { createApp } from 'vue';
import * as VueRouter from 'vue-router';
import Main from './components/Main';
import { routes } from './routes';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import { createStore } from 'vuex';
import { createAuth } from '@websanova/vue-auth';
import driverAuthBearer from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
import VueLodash from 'vue-lodash';
import lodash from 'lodash';
import { ZiggyVue } from 'ziggy';
import route from 'ziggy';
import { Ziggy } from './ziggy';
import { $http } from './api.js';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/lib/components';
import * as directives from 'vuetify/lib/directives';

window.route = route;
window.Ziggy = Ziggy;
window._ = require('lodash');

const router = VueRouter.createRouter({
    mode: "history",
    history: VueRouter.createWebHistory(),
    routes,
});

const auth = createAuth({
    plugins: {
        http: $http,
        router: router,
    },
    drivers: {
        http: driverHttpAxios,
        auth: driverAuthBearer,
        router: driverRouterVueRouter,
    },
    options: {
        rolesKey: 'type',
        notFoundRedirect: {name: 'home'},
    }
});

const vuetify = createVuetify({
    components,
    directives,
});

const vue = createApp(Main);
vue.use(vuetify);
vue.use(ElementPlus);
vue.use(router);
vue.use(auth);
vue.use(ZiggyVue, Ziggy);
vue.use(VueLodash, {name: 'custom'});
vue.provide('router', router);
vue.provide('auth', auth);
vue.provide('lodash', VueLodash);
vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});
vue.mount('#app');
