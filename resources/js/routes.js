import {createWebHistory, createRouter} from "vue-router";

import Index from './Pages/Home/Index';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Index
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
