<template>
  <div>
    <PieChart :chart-data="chartData" :chart-options="chartOptions" />
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from 'chart.js';
import { PieChart } from 'vue-chartjs';

ChartJS.register(Title, Tooltip, Legend, ArcElement);

const props = defineProps({
  tickets: Array
});

const chartData = ref({
  labels: [],
  datasets: [
    {
      label: 'توزيع التذاكر',
      backgroundColor: ['#3b82f6','#f97316','#10b981','#facc15'],
      data: []
    }
  ]
});

const chartOptions = ref({
  responsive: true,
  plugins: {
    legend: { position: 'top' },
    title: { display: true, text: 'توزيع التذاكر حسب الحدث' }
  }
});

watch(() => props.tickets, (tickets) => {
  if(tickets) {
    chartData.value.labels = tickets.map(t => t.event.title);
    chartData.value.datasets[0].data = tickets.map(t => t.quantity - t.sold);
  }
}, { immediate: true });
</script>
