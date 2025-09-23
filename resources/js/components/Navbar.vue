<template>
  <nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <!-- Logo / Title -->
    <div class="font-bold text-xl">Event System</div>

    <!-- Navigation Links -->
    <div class="space-x-4">
      <Link href="/dashboard" class="hover:underline">Dashboard</Link>
      <Link href="/events" class="hover:underline">Events</Link>
      <Link href="/orders" class="hover:underline">Orders</Link>
      <Link href="/profile" class="hover:underline">Profile</Link>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
/* أي تحسينات إضافية للـ hover أو active state */
</style>
