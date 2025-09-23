<template>
  <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors" dir="rtl">

    <!-- Navbar -->
    <header class="bg-white dark:bg-gray-800 shadow-md p-4 flex justify-between items-center fixed w-full z-50">
      <h1 class="text-xl font-bold">نظام الفعاليات</h1>
      <div class="flex items-center gap-4">
        <span>مرحبا، {{ userName }}</span>
        <button @click="toggleDarkMode" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">
          <i v-if="!isDark" class="fas fa-moon"></i>
          <i v-else class="fas fa-sun"></i>
        </button>
        <button @click="logout" class="text-red-500 hover:underline">تسجيل الخروج</button>
        <button class="sm:hidden px-3 py-1 rounded bg-gray-200 dark:bg-gray-700" @click="sidebarOpen = !sidebarOpen">☰</button>
      </div>
    </header>

    <div class="flex flex-1 pt-16">

      <!-- Overlay عند فتح Sidebar -->
      <div v-if="sidebarOpen" class="fixed inset-0 bg-black bg-opacity-50 z-40 sm:hidden" @click="sidebarOpen = false"></div>

      <!-- Sidebar -->
      <aside :class="[
          'fixed inset-y-0 right-0 w-64 bg-white dark:bg-gray-800 shadow-md transform transition-transform duration-300 ease-in-out flex flex-col z-50',
          sidebarOpen ? 'translate-x-0' : 'translate-x-full',
          'sm:translate-x-0 sm:static sm:flex-shrink-0'
        ]">
        <div class="p-4 text-xl font-bold border-b dark:border-gray-700">لوحة التحكم</div>
        <nav class="p-4 space-y-2 flex-1">
          <Link href="/dashboard" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">لوحة التحكم</Link>
          <Link href="/events" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الأحداث</Link>
          <Link href="/orders" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الطلبات</Link>
          <Link href="/profile" class="block p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">الملف الشخصي</Link>
        </nav>
        <div class="p-4 border-t dark:border-gray-700 text-gray-500 text-sm">&copy; 2025 لوحة التحكم</div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6 overflow-auto sm:mr-64">
        <div class="space-y-6">

          <h1 class="text-3xl font-bold mb-4">الأحداث</h1>

          <!-- إضافة حدث جديد -->
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">إضافة حدث جديد</h2>
            <form @submit.prevent="addEvent" class="space-y-4">

              <div>
                <label class="block mb-1 font-medium">العنوان</label>
                <input v-model="newEvent.title" type="text" class="w-full border rounded px-3 py-2" required>
              </div>

              <div>
                <label class="block mb-1 font-medium">الموقع</label>
                <input v-model="newEvent.location" type="text" class="w-full border rounded px-3 py-2" required>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block mb-1 font-medium">تاريخ البداية</label>
                  <input v-model="newEvent.start_date" type="date" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                  <label class="block mb-1 font-medium">تاريخ النهاية</label>
                  <input v-model="newEvent.end_date" type="date" class="w-full border rounded px-3 py-2" required>
                </div>
              </div>

              <div>
                <label class="block mb-1 font-medium">الوصف</label>
                <textarea v-model="newEvent.description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
              </div>

              <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">حفظ الحدث</button>
              </div>

            </form>
          </div>

          <!-- جدول عرض الأحداث -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 max-h-[400px] overflow-auto">
            <h2 class="text-xl font-semibold mb-4">قائمة الأحداث</h2>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0">
                  <tr>
                    <th class="px-2 py-1 text-right text-sm font-medium whitespace-nowrap">العنوان</th>
                    <th class="px-2 py-1 text-right text-sm font-medium whitespace-nowrap">الموقع</th>
                    <th class="px-2 py-1 text-right text-sm font-medium whitespace-nowrap">تاريخ البداية</th>
                    <th class="px-2 py-1 text-right text-sm font-medium whitespace-nowrap">تاريخ النهاية</th>
                    <th class="px-2 py-1 text-right text-sm font-medium whitespace-nowrap">الوصف</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  <tr v-for="event in events" :key="event.id">
                    <td class="px-2 py-1 text-gray-700 dark:text-gray-100 whitespace-nowrap">{{ event.title }}</td>
                    <td class="px-2 py-1 text-gray-700 dark:text-gray-100 whitespace-nowrap">{{ event.location }}</td>
                    <td class="px-2 py-1 text-gray-700 dark:text-gray-100 whitespace-nowrap">{{ formatDate(event.start_date) }}</td>
                    <td class="px-2 py-1 text-gray-700 dark:text-gray-100 whitespace-nowrap">{{ formatDate(event.end_date) }}</td>
                    <td class="px-2 py-1 text-gray-700 dark:text-gray-100 break-words max-w-xs">{{ event.description }}</td>
                  </tr>
                  <tr v-if="events.length === 0">
                    <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">لا يوجد أحداث بعد</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const sidebarOpen = ref(false);
const userName = ref('المسؤول');
const isDark = ref(false);

const newEvent = ref({
  title: '',
  location: '',
  start_date: '',
  end_date: '',
  description: ''
});

const events = ref([]);

// جلب جميع الأحداث
async function loadEvents() {
  try {
    const res = await axios.get('/api/events');
    events.value = res.data;
  } catch (err) {
    console.error(err.response?.data || err.message);
  }
}

// إضافة حدث جديد
async function addEvent() {
  try {
    const res = await axios.post('/api/events', newEvent.value);
    events.value.push(res.data);
    newEvent.value = { title: '', location: '', start_date: '', end_date: '', description: '' };
    alert('تم حفظ الحدث بنجاح!');
  } catch (err) {
    console.error(err.response?.data || err.message);
    alert('حدث خطأ أثناء الحفظ');
  }
}

// تسجيل خروج
function logout() {
  Inertia.post('/logout');
}

// تبديل الوضع الداكن
function toggleDarkMode() {
  isDark.value = !isDark.value;
  document.documentElement.classList.toggle('dark', isDark.value);
}

// تنسيق التاريخ
function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('ar-YE');
}

onMounted(() => {
  loadEvents();
});
</script>ِ

<style scoped>
main::-webkit-scrollbar {
  width: 8px;
}
main::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 4px;
}
aside { transition: transform 0.3s ease-in-out; }
</style>
