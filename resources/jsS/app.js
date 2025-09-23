// import { createApp } from 'vue';
// import EventsList from './components/EventsList.vue';

// const app = createApp({});
// app.component('events-list', EventsList);
// app.mount('#app');





import './bootstrap';
import { createApp } from 'vue';

// استورد الـ App الأساسي (لو عندك تصميم رئيسي)
import App from './App.vue';

// استورد الصفحة اللي تبغاها
// import MyPage from './pages/Dashboard.vue';
import Dashboard from './pages/Dashboard.vue';


// أنشئ التطبيق
const app = createApp(App);

// سجل المكون الجديد
// app.component('dashboard-vue', Dashboard);
app.component('dashboard-page', Dashboard);

// اربطه بالـ div في الـ Blade
app.mount('#app');

