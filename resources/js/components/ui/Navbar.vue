<template>
  <nav class="bg-gray-800 text-white p-4 flex justify-between">
    <div class="font-bold text-lg">Event Manager</div>
    <div>
      <router-link to="/" class="mr-4">Dashboard</router-link>
      <router-link to="/events" class="mr-4">Events</router-link>
      <router-link to="/tickets" class="mr-4">Tickets</router-link>
      <router-link to="/profile">Profile</router-link>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
};
</script>

<style scoped>
a.router-link-active {
  font-weight: bold;
  text-decoration: underline;
}
</style>
