<template>
  <div class="min-h-screen flex flex-col">
    <nav class="bg-blue-600 text-white p-4 flex justify-between items-center">
      <div class="text-xl font-bold">Event System</div>
      <div>
        <router-link to="/" class="px-3 hover:text-gray-200">Home</router-link>
        <router-link to="/events" class="px-3 hover:text-gray-200">Events</router-link>
        <router-link to="/tickets" class="px-3 hover:text-gray-200">Tickets</router-link>
        <router-link to="/profile" class="px-3 hover:text-gray-200">Profile</router-link>
      </div>
    </nav>

    <main class="flex-1 p-6 bg-gray-100">
      <router-view />
    </main>

    <footer class="bg-blue-600 text-white p-4 text-center">
      &copy; 2025 Event System. All rights reserved.
    </footer>
  </div>
</template>

<script>
export default { name: "App" };
</script>
