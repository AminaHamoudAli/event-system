<template>
  <div dir="rtl" class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors">
    <!-- Navbar + Sidebar -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">نظام الفعاليات</h1>
      <div class="flex items-center gap-4">
        <span>مرحبا، {{ userName }}</span>
        <button
          @click="logout"
          class="text-red-500 hover:underline bg-transparent border-none p-0"
        >
          تسجيل الخروج
        </button>
        <button
          class="sm:hidden px-3 py-1 rounded bg-gray-200"
          @click="sidebarOpen = true"
        >
          ☰
        </button>
      </div>
    </header>

    <div class="flex flex-1">
      <!-- Overlay عند فتح Sidebar على الموبايل -->
      <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black bg-opacity-50 z-20 sm:hidden"
        @click="sidebarOpen = false"
      ></div>

      <!-- Sidebar -->
      <aside
        :class="[
          'fixed z-30 inset-y-0 right-0 w-64 bg-white shadow-md transform transition-transform duration-300 ease-in-out flex flex-col',
          sidebarOpen ? 'translate-x-0' : 'translate-x-full',
          'sm:translate-x-0 sm:static sm:flex-shrink-0'
        ]"
      >
        <div class="p-4 text-xl font-bold border-b">نظام الفعاليات</div>
        <nav class="p-4 space-y-2 flex-1">
          <Link href="/dashboard" class="block p-2 rounded hover:bg-gray-200">لوحة التحكم</Link>
          <Link href="/events" class="block p-2 rounded hover:bg-gray-200">الأحداث</Link>
          <Link href="/orders" class="block p-2 rounded hover:bg-gray-200">الطلبات</Link>
          <Link href="/profile" class="block p-2 rounded hover:bg-gray-200">الملف الشخصي</Link>
        </nav>
        <div class="p-4 border-t text-gray-500 text-sm">
          &copy; 2025 نظام الفعاليات
        </div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6 overflow-auto mr-0 sm:mr-64">
        <div class="space-y-4">
          <h1 class="text-3xl font-bold text-gray-800">إدارة الطلبات</h1>

          <!-- شريط البحث -->
          <div class="mb-4">
            <input
              v-model="search"
              type="text"
              placeholder="ابحث باسم المستخدم أو اسم الحدث..."
              class="w-full border rounded px-3 py-2"
            />
          </div>

          <!-- جدول الطلبات -->
          <div class="bg-white shadow rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">المستخدم</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">الحدث</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">نوع التذكرة</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">الكمية</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">الإجمالي</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">تاريخ الطلب</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr v-for="order in filteredOrders" :key="order.id">
                  <td class="px-4 py-2 text-gray-700 text-right">{{ order.user.name }}</td>
                  <td class="px-4 py-2 text-gray-700 text-right">{{ order.ticket.event.title }}</td>
                  <td class="px-4 py-2 text-gray-700 text-right">{{ order.ticket.ticket_type }}</td>
                  <td class="px-4 py-2 text-gray-700 text-right">{{ order.quantity }}</td>
                  <td class="px-4 py-2 text-gray-700 text-right">{{ order.total | currency }}</td>
                  <td class="px-4 py-2 text-gray-700 text-right">{{ new Date(order.created_at).toLocaleDateString('ar-EG') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>


<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
// const res = await axios.get('/api/orders');
axios.get('/api/orders')


const sidebarOpen = ref(false);
const userName = ref('المسؤول');
const search = ref('');
const orders = ref([]);

function logout() {
  Inertia.post('/logout');
}

const filteredOrders = computed(() => {
  if (!search.value) return orders.value;
  return orders.value.filter(order =>
    order.user.name.toLowerCase().includes(search.value.toLowerCase()) ||
    order.ticket.event.title.toLowerCase().includes(search.value.toLowerCase())
  );
});

async function loadOrders() {
  try {
    const res = await axios.get('/api/orders');
    orders.value = res.data;
  } catch (err) {
    console.error(err);
  }
}

onMounted(() => {
  loadOrders();
});
</script>

<style scoped>
main::-webkit-scrollbar {
  width: 8px;
}
main::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 4px;
}
</style>
