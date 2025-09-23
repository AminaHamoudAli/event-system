<template>
  <div class="relative flex flex-col items-center justify-center min-h-screen overflow-hidden bg-gradient-to-br from-pink-500 via-purple-500 to-indigo-600 dark:from-gray-800 dark:via-gray-900 dark:to-black text-white">
    
    <!-- دوائر متحركة -->
    <span
      v-for="n in 6"
      :key="n"
      class="absolute rounded-full bg-white opacity-20 animate-bounce"
      :style="{
        width: `${50 + n*20}px`,
        height: `${50 + n*20}px`,
        top: `${Math.random() * 80}vh`,
        left: `${Math.random() * 80}vw`,
        animationDelay: `${Math.random()*2}s`,
        animationDuration: `${3 + Math.random()*2}s`
      }"
    ></span>

    <!-- النصوص -->
    <h1 class="text-8xl md:text-9xl font-extrabold mb-4 animate-pulse drop-shadow-lg">404</h1>
    <p class="text-2xl md:text-3xl mb-6 animate-pulse drop-shadow-md">الصفحة غير موجودة</p>

    <!-- زر العودة -->
    <Link
      href="/"
      class="px-6 py-3 bg-white text-indigo-600 font-bold rounded-full shadow-lg transform transition duration-300 hover:scale-110 hover:bg-indigo-600 hover:text-white animate-bounce"
    >
      الرجوع للرئيسية
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

.animate-bounce {
  animation: bounce 2s infinite ease-in-out;
}
</style>
