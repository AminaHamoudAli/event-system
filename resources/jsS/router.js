// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';

// استيراد الصفحات
import Dashboard from './views/Dashboard.vue';
import Events from './views/Events.vue';

const routes = [
    { path: '/', name: 'dashboard', component: Dashboard },
    { path: '/events', name: 'events', component: Events },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
