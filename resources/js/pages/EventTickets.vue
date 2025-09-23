<template>
  <MainLayout>
    <div class="p-6 space-y-6">
      <h1 class="text-3xl font-bold text-gray-800">
        إدارة التذاكر - {{ event.title }}
      </h1>

      <!-- نموذج إضافة تذكرة جديدة -->
      <form @submit.prevent="addTicket" class="bg-white shadow rounded-lg p-6 space-y-4">
        <div>
          <label class="block text-gray-700">نوع التذكرة</label>
          <input v-model="newTicket.ticket_type" type="text" class="w-full border rounded px-3 py-2">
          <p v-if="errors.ticket_type" class="text-red-500 text-sm">{{ errors.ticket_type[0] }}</p>
        </div>

        <div>
          <label class="block text-gray-700">السعر</label>
          <input v-model="newTicket.price" type="number" step="0.01" class="w-full border rounded px-3 py-2">
          <p v-if="errors.price" class="text-red-500 text-sm">{{ errors.price[0] }}</p>
        </div>

        <div>
          <label class="block text-gray-700">الكمية</label>
          <input v-model="newTicket.quantity" type="number" min="1" class="w-full border rounded px-3 py-2">
          <p v-if="errors.quantity" class="text-red-500 text-sm">{{ errors.quantity[0] }}</p>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          إضافة تذكرة
        </button>
      </form>

      <!-- جدول التذاكر الحالية -->
      <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">التذاكر الحالية</h2>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">نوع التذكرة</th>
              <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">السعر</th>
              <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">الكمية المتاحة</th>
              <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">تم البيع</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr v-for="ticket in tickets" :key="ticket.id">
              <td class="px-4 py-2 text-gray-700">{{ ticket.ticket_type }}</td>
              <td class="px-4 py-2 text-gray-700">{{ formatCurrency(ticket.price) }}</td>
              <td class="px-4 py-2 text-gray-700">{{ ticket.quantity }}</td>
              <td class="px-4 py-2 text-gray-700">{{ ticket.sold }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </MainLayout>
</template>

<script>
// import MainLayout from '../Layouts/MainLayout.vue';
import axios from 'axios';

export default {
  props: {
    eventId: Number,   // Laravel يمرر هذا
    event: Object      // تفاصيل الحدث (اختياري)
  },
  components: { MainLayout },
  data() {
    return {
      tickets: [],
      newTicket: { ticket_type: '', price: '', quantity: 1 },
      errors: {}
    };
  },
  mounted() {
    this.loadTickets();
  },
  methods: {
    async loadTickets() {
      const res = await axios.get(`/api/events/${this.eventId}/tickets`);
      this.tickets = res.data.map(ticket => ({
        ...ticket,
        sold: ticket.orders.reduce((sum, o) => sum + o.quantity, 0)
      }));
    },
    async addTicket() {
      try {
        const res = await axios.post(`/api/events/${this.eventId}/tickets`, this.newTicket);
        this.tickets.push({ ...res.data, sold: 0 });
        this.newTicket = { ticket_type: '', price: '', quantity: 1 };
        this.errors = {};
      } catch (err) {
        if (err.response?.data?.errors) {
          this.errors = err.response.data.errors;
        }
      }
    },
    formatCurrency(value) {
      if (!value) return '0.00';
      return parseFloat(value).toLocaleString('ar-EG', { style: 'currency', currency: 'EGP' });
    }
  }
};
</script>

<style scoped>
/* تحسينات بسيطة للواجهة */
</style>
