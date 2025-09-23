<template>
  <div>
    <LineChart :chart-data="chartData" :chart-options="chartOptions" />
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale } from 'chart.js';
import { LineChart } from 'vue-chartjs';

ChartJS.register(Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale);

const props = defineProps({
  revenue: Array
});

const chartData = ref({
  labels: [],
  datasets: [
    {
      label: 'الإيرادات',
      borderColor: '#f97316',
      backgroundColor: 'rgba(249,115,22,0.2)',
      data: []
    }
  ]
});

const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: { position: 'top' },
    title: { display: true, text: 'الإيرادات الشهرية' }
  }
});

watch(() => props.revenue, (revenue) => {
  if(revenue) {
    chartData.value.labels = revenue.map(r => r.month);
    chartData.value.datasets[0].data = revenue.map(r => r.amount);
  }
}, { immediate: true });
</script>
