import { createRouter, createWebHistory } from 'vue-router';
import HomeView from './views/HomeView.vue';
import LoginView from './views/LoginView.vue';
import EventView from './views/EventView.vue';

const routes = [
    {
        path: '/',
        component: HomeView,
    },
    {
        path: '/login',
        component: LoginView,
    },
    {
        path: '/event',
        component: EventView,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
