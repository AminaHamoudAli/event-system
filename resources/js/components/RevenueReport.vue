<template>
  <div class="p-6 bg-white rounded-lg shadow-md max-w-3xl mx-auto">
    <div class="grid grid-cols-2 gap-4 mb-4">
      <h2 class="text-xl font-semibold">Sales</h2>
      <h2 class="text-xl font-semibold">Revenue</h2>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
      <h3 class="text-blue-600 text-lg font-bold">{{ report_data.total_sold }}</h3>
      <h3 class="text-blue-600 text-lg font-bold">${{ report_data.total_revenue }}</h3>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">Type</th>
            <th class="px-4 py-2 border">Normal</th>
            <th class="px-4 py-2 border">Silver</th>
            <th class="px-4 py-2 border">Gold</th>
            <th class="px-4 py-2 border">Platinum</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center">
            <td class="px-4 py-2 border font-medium">Count</td>
            <td class="px-4 py-2 border">{{ report_data.n_count }}</td>
            <td class="px-4 py-2 border">{{ report_data.s_count }}</td>
            <td class="px-4 py-2 border">{{ report_data.g_count }}</td>
            <td class="px-4 py-2 border">{{ report_data.p_count }}</td>
          </tr>
          <tr class="text-center bg-gray-50">
            <td class="px-4 py-2 border font-medium">Revenue</td>
            <td class="px-4 py-2 border">${{ report_data.n_rev }}</td>
            <td class="px-4 py-2 border">${{ report_data.s_rev }}</td>
            <td class="px-4 py-2 border">${{ report_data.g_rev }}</td>
            <td class="px-4 py-2 border">${{ report_data.p_rev }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
// import axios from '../vuexios';
import axios from 'axios';


export default {
  name: 'RevenueReport',
  data() {
    return {
      report_data: [],
    };
  },
  mounted() {
    axios
      .get('/getsalesoverview')
      .then(response => {
        this.report_data = response.data;
      })
      .catch(error => console.log(error.message));
  },
};
</script>

<style scoped>
</style>
