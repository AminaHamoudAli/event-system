<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Overlay عند فتح Sidebar على الموبايل -->
    <div
      v-if="sidebarOpen"
      class="fixed inset-0 bg-black bg-opacity-50 z-20"
      @click="sidebarOpen = false"
    ></div>

    <!-- Sidebar -->
    <aside
      :class="[
        'fixed z-30 inset-y-0 left-0 w-64 bg-white shadow-md transform transition-transform duration-300 ease-in-out flex flex-col',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full',
        'sm:translate-x-0 sm:static'
      ]"
    >
      <div class="p-4 text-xl font-bold border-b">نظام الفعاليات</div>
      <nav class="p-4 space-y-2 flex-1">
        <Link href="/dashboard" class="block p-2 rounded hover:bg-gray-200">لوحة التحكم</Link>
        <!-- <Link href="/events" class="block p-2 rounded hover:bg-gray-200">الأحداث</Link>
        <Link href="/orders" class="block p-2 rounded hover:bg-gray-200">الطلبات</Link> -->
        <Link href="/events" class="block p-2 rounded hover:bg-gray-200">الأحداث</Link>
        <Link href="/orders" class="block p-2 rounded hover:bg-gray-200">الطلبات</Link>
        <Link href="/orders" class="block p-2 rounded hover:bg-gray-200">الطلبات</Link>
        <Link href="/EventTickets" class="block p-2 rounded hover:bg-gray-200">دارة التذاكر</Link>

        <Link href="/profile" class="block p-2 rounded hover:bg-gray-200">الملف الشخصي</Link>
      </nav>
      <div class="p-4 border-t text-gray-500 text-sm">
        &copy; 2025 نظام الفعاليات
      </div>
    </aside>
   

    <!-- Main Content -->
    <!-- Navbar -->
    <!-- <div class="flex-1 flex flex-col">
      <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">نظام الفعاليات</h1>
        <div class="flex items-center">
          <span class="mr-4">مرحبا، {{ userName }}</span>
          <Link href="/logout" class="text-red-500 hover:underline">تسجيل الخروج</Link>
          <button
            class="sm:hidden ml-4 px-3 py-1 rounded bg-gray-200"
            @click="sidebarOpen = true"
          >
            ☰
          </button>
        </div>
      </header>

    
      <main class="flex-1 p-6 overflow-auto">
        <slot />
      </main>

     
      <footer class="bg-white shadow-inner p-4 text-center text-gray-500 mt-auto">
        &copy; 2025 نظام الفعاليات. جميع الحقوق محفوظة.
      </footer>
    </div> -->
    
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';


const sidebarOpen = ref(false);
const userName = ref('المسؤول');
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
