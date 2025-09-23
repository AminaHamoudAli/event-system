import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../views/Dashboard.vue';
import Events from '../views/Events.vue';
import EventDetails from '../views/EventDetails.vue';
import Tickets from '../views/Tickets.vue';
import Profile from '../views/Profile.vue';
import Login from '../views/Login.vue';

const routes = [
    { path: '/', name: 'dashboard', component: Dashboard },
    { path: '/events', name: 'events', component: Events },
    { path: '/events/:id', name: 'event.details', component: EventDetails },
    { path: '/tickets', name: 'tickets', component: Tickets },
    { path: '/profile', name: 'profile', component: Profile },
    { path: '/login', name: 'login', component: Login },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
