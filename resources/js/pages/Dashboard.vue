<template>
  <div class="flex flex-col min-h-screen bg-gray-50 dark:bg-zinc-900 text-black/90 dark:text-white/90 transition-colors" dir="rtl">
    
    <!-- Navbar -->
    <header class="bg-white dark:bg-zinc-950 shadow-md p-4 flex justify-between items-center fixed w-full z-50">
      <h1 class="text-xl font-bold text-[#FF2D20]">نظام الفعاليات</h1>
      <div class="flex items-center gap-4">
        <span>مرحبا، {{ userName }}</span>
        <button @click="toggleDarkMode" class="p-2 rounded-lg hover:bg-red-200 bg-red-600 dark:hover:bg-gray-700">
          <i v-if="!isDark" class="fas fa-moon text-gray-600"></i>
          <i v-else class="fas fa-sun text-yellow-400"></i>
        </button>
        <button @click="logout" class="text-red-500 hover:underline">تسجيل الخروج</button>
        <button class="sm:hidden px-3 py-1 rounded bg-gray-200 dark:bg-gray-700" @click="sidebarOpen = true">☰</button>
      </div>
    </header>

    <div class="flex flex-1 pt-16">
      <!-- Overlay عند فتح Sidebar على الموبايل -->
      <div v-if="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden" @click="sidebarOpen = false"></div>

      <!-- Sidebar -->
      <aside :class="[
        'fixed inset-y-0 right-0 w-64 bg-white dark:bg-zinc-950 shadow-md transform transition-transform duration-300 ease-in-out flex flex-col z-50',
        sidebarOpen ? 'translate-x-0' : 'translate-x-full',
        'sm:translate-x-0 sm:static sm:flex-shrink-0'
      ]">
        <div class="p-4 text-xl font-bold border-b dark:border-gray-700 text-[#FF2D20]">نظام الفعاليات</div>
        <nav class="p-4 space-y-2 flex-1">
          <Link href="/dashboard" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">لوحة التحكم</Link>
          <Link href="/events" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الأحداث</Link>
          <Link href="/orders" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الطلبات</Link>
          <Link href="/event-details" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">تفاصيل الحدث</Link>
          <Link href="/event-tickets" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">إدارة التذاكر</Link>
          <Link href="/profile" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الملف الشخصي</Link>
        </nav>
        <div class="p-4 border-t dark:border-gray-700 text-gray-500 text-sm">&copy; 2025 نظام الفعاليات</div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6 overflow-auto sm:mr-64">
        <div class="space-y-6">
          <h1 class="text-3xl font-bold text-[#FF2D20] mb-6">لوحة التحكم</h1>

          <!-- بطاقات الإحصائيات -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <p class="text-gray-500 dark:text-gray-400">عدد الأحداث</p>
              <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ stats.events }}</p>
            </div>
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <p class="text-gray-500 dark:text-gray-400">التذاكر المباعة</p>
              <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ stats.tickets_sold }}</p>
            </div>
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <p class="text-gray-500 dark:text-gray-400">الإيرادات</p>
              <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">{{ stats.revenue | currency }}</p>
            </div>
          </div>

          <!-- الرسوم البيانية
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-4">مبيعات التذاكر</h3>
              <BarChart :chart-data="chartData1" :chart-options="chartOptions" />
            </div>
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-4">الإيرادات حسب الحدث</h3>
              <PieChart :chart-data="chartData2" :chart-options="chartOptions" />
            </div>
            <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-4">عدد الحضور</h3>
              <LineChart :chart-data="chartData3" :chart-options="chartOptions" />
            </div>
          </div> -->

          <!-- جداول الطلبات -->
          <!-- <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6 overflow-x-auto mb-6">
            <h2 class="text-xl font-semibold mb-4">أحدث الطلبات</h2>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-zinc-950">
                <tr>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">المستخدم</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">الحدث</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">الكمية</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">الإجمالي</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr v-for="order in recentOrders" :key="order.id">
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ order.user.name }}</td>
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ order.ticket.event.title }}</td>
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ order.quantity }}</td>
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ order.total | currency }}</td>
                </tr>
              </tbody>
            </table>
          </div> -->

          <!-- جدول التذاكر -->
          <div class="bg-white dark:bg-zinc-900 shadow rounded-lg p-6 overflow-x-auto">
            <h2 class="text-xl font-semibold mb-4">التذاكر المتاحة حسب الحدث</h2>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-zinc-950">
                <tr>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">الحدث</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">نوع التذكرة</th>
                  <th class="px-4 py-2 text-right text-sm font-medium text-gray-500 dark:text-gray-300">الكمية المتاحة</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <tr v-for="ticket in tickets" :key="ticket.id">
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ ticket.event.title }}</td>
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ ticket.ticket_type }}</td>
                  <td class="px-4 py-2 text-gray-700 dark:text-gray-100">{{ ticket.quantity - ticket.sold }}</td>
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
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

// Chart.js
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement, LineElement, PointElement } from 'chart.js';
import { Bar, Pie, Line } from 'vue-chartjs';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement, LineElement, PointElement);

const sidebarOpen = ref(false);
const userName = ref('المسؤول');
const isDark = ref(false);

const stats = ref({ events: 0, tickets_sold: 0, revenue: 0 });
const recentOrders = ref([]);
const tickets = ref([]);

const chartData1 = ref({ labels: [], datasets: [] });
const chartData2 = ref({ labels: [], datasets: [] });
const chartData3 = ref({ labels: [], datasets: [] });

const chartOptions = { responsive: true, plugins: { legend: { position: 'top' } } };

function logout() { Inertia.post('/logout'); }
function toggleDarkMode() { isDark.value = !isDark.value; document.documentElement.classList.toggle('dark', isDark.value); }
function currency(value) { if(!value) return '0.00'; return parseFloat(value).toLocaleString('ar-EG', { style:'currency', currency:'EGP' }); }

async function loadStats() { const res = await axios.get('/api/dashboard/stats'); stats.value = res.data; }
async function loadRecentOrders() { const res = await axios.get('/api/orders/recent'); recentOrders.value = res.data; }
async function loadTickets() { 
  const res = await axios.get('/api/tickets'); 
  tickets.value = res.data.map(ticket => ({ ...ticket, sold: ticket.orders.reduce((sum,o)=>sum+o.quantity,0) }));
}
async function loadCharts() {
  chartData1.value = { labels:['حدث 1','حدث 2','حدث 3'], datasets:[{label:'مبيعات التذاكر', data:[50,75,30], backgroundColor:'#FF2D20'}] };
  chartData2.value = { labels:['حدث 1','حدث 2','حدث 3'], datasets:[{label:'الإيرادات', data:[500,700,300], backgroundColor:['#FF2D20','#F59E0B','#10B981']}] };
  chartData3.value = { labels:['يناير','فبراير','مارس'], datasets:[{label:'عدد الحضور', data:[120,200,150], borderColor:'#FF2D20', backgroundColor:'#FF2D2022', tension:0.4}] };
}

onMounted(()=>{ loadStats(); loadRecentOrders(); loadTickets(); loadCharts(); });
</script>

<style scoped>
main::-webkit-scrollbar { width: 8px; }
main::-webkit-scrollbar-thumb { background-color: rgba(0,0,0,0.2); border-radius: 4px; }
aside { transition: transform 0.3s ease-in-out; }
</style>

