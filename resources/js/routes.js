import Home from './components/Front/Home.vue';
import Register from './components/Front/Login.vue';
import Dashboard from './components/Admin/Dashboard.vue';
import AddResume from './components/Admin/AddResume.vue';
import EditResume from './components/Admin/EditResume.vue';
import Positions from './components/Admin/Position/Positions';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'login',
        path: '/login',
        component: Register,
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: {
            auth: true,
        },
    },
    {
        name: 'positions',
        path: '/positions',
        component: Positions,
        meta: {
            auth: true,
        },
    },
    {
        name: 'addResume',
        path: '/add-resume',
        component: AddResume,
        meta: {
            auth: true,
        },
    },
    {
        name: 'editResume',
        path: '/edit-resume/:id',
        component: EditResume,
        meta: {
            auth: true,
        },
    },
];
