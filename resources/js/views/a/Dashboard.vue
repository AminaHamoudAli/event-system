<template>
  <div class="min-h-screen bg-gray-100 text-gray-900">
    <Navbar />

    <div class="container mx-auto px-4 py-8 md:px-12">
      <div class="flex flex-col md:flex-row items-center justify-between mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
          📊 لوحة التحكم
        </h1>
        <p class="text-gray-500 mt-2 md:mt-0 text-lg">
          نظرة عامة على أداء نظام إدارة الفعاليات.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
          <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-2">
            <i class="fas fa-calendar-alt text-blue-500 mr-3"></i> الفعاليات الكلية
          </h2>
          <p class="text-4xl font-bold text-blue-600">{{ stats.events }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
          <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-2">
            <i class="fas fa-ticket-alt text-green-500 mr-3"></i> إجمالي التذاكر المباعة
          </h2>
          <p class="text-4xl font-bold text-green-600">{{ stats.tickets_sold }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
          <h2 class="text-lg font-semibold text-gray-700 flex items-center mb-2">
            <i class="fas fa-dollar-sign text-purple-500 mr-3"></i> الإيرادات
          </h2>
          <p class="text-4xl font-bold text-purple-600">${{ stats.revenue }}</p>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  components: { Navbar },
  data() {
    return {
      stats: {
        events: 0,
        tickets_sold: 0,
        revenue: 0
      }
    };
  },
  mounted() {
    axios.get('/dashboard-stats')
      .then(res => {
        this.stats = res.data;
      })
      .catch(err => console.error(err));
  }
};
</script>

<style scoped>
/* لا حاجة لكتابة CSS هنا، Tailwind CSS يفي بالغرض */
</style>