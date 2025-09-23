<template>
  <div class="overflow-x-auto max-h-[500px] p-4">
    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
      <thead class="bg-gray-100 sticky top-0">
        <tr>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Event ID</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ticket Type</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Customer Name</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">No. of tickets</th>
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Cost</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <tr v-for="(tr, i) in report_data" :key="i" class="hover:bg-gray-50">
          <td class="px-4 py-2 text-sm text-gray-700">#{{ tr.event_id }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.e_name }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.e_date }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.t_type }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.c_name }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.c_email }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.no_of_tickets }}</td>
          <td class="px-4 py-2 text-sm text-gray-700">{{ tr.cost }}$</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
// import axios from '../vuexios';
import axios from 'axios';


export default {
  name: 'BookingReport',
  data() {
    return {
      report_data: [],
    };
  },
  mounted() {
    axios
      .get('/getbookingdetails')
      .then(response => {
        this.report_data = response.data;
      })
      .catch(error => console.log(error.message));
  },
};
</script>

<style scoped>
/* لإضافة تمرير رأسي للجدول */
div::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}
div::-webkit-scrollbar-thumb {
  background-color: rgba(107, 114, 128, 0.5);
  border-radius: 3px;
}
</style>
