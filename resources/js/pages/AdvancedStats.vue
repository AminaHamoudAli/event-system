<template>
  <MainLayout>
    <div class="p-6 space-y-6">
      <h1 class="text-3xl font-bold text-gray-800">الإحصائيات المتقدمة</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- رسم بياني لعدد التذاكر المباعة لكل حدث -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-xl font-semibold mb-4">التذاكر المباعة لكل حدث</h2>
          <canvas id="ticketsChart"></canvas>
        </div>

        <!-- رسم بياني للإيرادات لكل حدث -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-xl font-semibold mb-4">الإيرادات لكل حدث</h2>
          <canvas id="revenueChart"></canvas>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script>
import { Chart, registerables } from 'chart.js';
import MainLayout from '../layouts/MainLayout.vue';
import axios from 'axios';

Chart.register(...registerables);

export default {
  components: { MainLayout },
  data() {
    return {
      ticketsData: { labels: [], data: [] },
      revenueData: { labels: [], data: [] }
    };
  },
  mounted() {
    this.loadStats();
  },
  methods: {
    async loadStats() {
      try {
        // استدعاء API للحصول على الإحصائيات لكل حدث
        const res = await axios.get('/api/dashboard/advanced-stats');

        this.ticketsData.labels = res.data.map(item => item.event);
        this.ticketsData.data = res.data.map(item => item.tickets_sold);

        this.revenueData.labels = res.data.map(item => item.event);
        this.revenueData.data = res.data.map(item => item.revenue);

        this.renderTicketsChart();
        this.renderRevenueChart();
      } catch (err) {
        console.error(err);
      }
    },
    renderTicketsChart() {
      const ctx = document.getElementById('ticketsChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: this.ticketsData.labels,
          datasets: [{
            label: 'التذاكر المباعة',
            data: this.ticketsData.data,
            backgroundColor: '#3b82f6'
          }]
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true } }
        }
      });
    },
    renderRevenueChart() {
      const ctx = document.getElementById('revenueChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: this.revenueData.labels,
          datasets: [{
            label: 'الإيرادات',
            data: this.revenueData.data,
            borderColor: '#10b981',
            backgroundColor: 'rgba(16,185,129,0.2)',
            fill: true,
            tension: 0.3
          }]
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true } }
        }
      });
    }
  }
};
</script>

<style scoped>
/* تحسينات بسيطة على الواجهة */
</style>
