import Home from './components/Front/Home.vue';
import Register from './components/Front/Login.vue';
import Dashboard from './components/Admin/Dashboard.vue';
import AddResume from './components/Admin/AddResume.vue';
import EditResume from './components/Admin/EditResume.vue';
import Positions from './components/Admin/Position/Positions.vue';
import AddPosition from './components/Admin/Position/AddPosition.vue';
import EditPosition from './components/Admin/Position/EditPosition.vue';

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
        path: '/admin/dashboard',
        component: Dashboard,
        meta: {
            auth: true,
        },
    },
    {
        name: 'positions',
        path: '/admin/positions',
        component: Positions,
        meta: {
            auth: true,
        },
    },
    {
        name: 'addPosition',
        path: '/admin/add-position',
        component: AddPosition,
        meta: {
            auth: true,
        },
    },
    {
        name: 'editPosition',
        path: '/admin/edit-position/:id',
        component: EditPosition,
        meta: {
            auth: true,
        },
    },
    {
        name: 'addResume',
        path: '/admin/add-resume',
        component: AddResume,
        meta: {
            auth: true,
        },
    },
    {
        name: 'editResume',
        path: '/admin/edit-resume/:id',
        component: EditResume,
        meta: {
            auth: true,
        },
    },
];
