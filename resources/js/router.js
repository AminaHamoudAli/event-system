// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';

// Layout
import MainLayout from './layouts/MainLayout.vue';

// صفحاتك
import Dashboard from './views/Dashboard.vue';
import Events from './views/Event.vue';
import NewEvent from './views/NewEvent.vue';
import Reports from './views/Reports.vue';
import Login from './views/Login.vue';
import EditEvent from './views/EditEvent.vue';

const routes = [
  {
    path: '/',
    component: MainLayout, // كل الصفحات ضمن هذا الـ Layout
    children: [
      { path: '', name: 'dashboard', component: Dashboard },
      { path: 'events', name: 'events', component: Events },
      { path: 'new-event', name: 'new-event', component: NewEvent },
      { path: 'reports', name: 'reports', component: Reports },
      { path: 'edit-event/:id', name: 'edit-event', component: EditEvent, props: true },
    ],
  },
  {
    path: '/login',
    name: 'login',
    component: Login, // صفحة تسجيل الدخول خارج الـ Layout
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
