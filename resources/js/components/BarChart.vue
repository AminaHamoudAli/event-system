<template>
  <div>
    <BarChart :chart-data="chartData" :chart-options="chartOptions" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
import { BarChart } from 'vue-chartjs';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const chartData = ref({
  labels: ['يناير', 'فبراير', 'مارس', 'أبريل'],
  datasets: [
    {
      label: 'عدد التذاكر المباعة',
      backgroundColor: '#3b82f6',
      data: [30, 50, 40, 60]
    }
  ]
});

const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: { position: 'top' },
    title: { display: true, text: 'مبيعات التذاكر الشهرية' }
  }
});
</script>
