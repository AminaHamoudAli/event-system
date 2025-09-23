<template>
  <div class="p-6">
    <div class="overflow-auto max-h-[500px] border rounded-lg shadow">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 sticky top-0">
          <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Event ID</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Organizer</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ticket type</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">$ from Normal</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">$ from Silver</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">$ from Gold</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">$ from Platinum</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total revenue</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="tr in report_data" :key="tr.event_id">
            <td class="px-4 py-2">#{{ tr.event_id }}</td>
            <td class="px-4 py-2">{{ tr.e_name }}</td>
            <td class="px-4 py-2">{{ tr.e_organizer }}</td>
            <td class="px-4 py-2">{{ tr.e_date }}</td>
            <td class="px-4 py-2">{{ tr.t_type == 0 ? 'Normal' : 'Premium' }}</td>
            <td class="px-4 py-2">${{ tr.n_rev }}</td>
            <td class="px-4 py-2">${{ tr.s_rev }}</td>
            <td class="px-4 py-2">${{ tr.g_rev }}</td>
            <td class="px-4 py-2">${{ tr.p_rev }}</td>
            <td class="px-4 py-2">${{ tr.total_revenue }}</td>
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
  data() {
    return {
      report_data: [],
    };
  },
  mounted() {
    axios
      .get('/getsalesdetails')
      .then(response => {
        this.report_data = response.data;
      })
      .catch(error => console.log(error.message));
  },
  name: 'EventReport',
};
</script>

<style scoped>
/* يمكنك إضافة أي تخصيص إضافي إذا أحببت */
</style>
