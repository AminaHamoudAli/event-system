<template>
  <div class="border p-4 rounded shadow hover:shadow-lg transition">
    <h2 class="font-bold text-xl mb-2">{{ event.title }}</h2>
    <p class="text-gray-700">{{ event.description }}</p>
    <p class="mt-2 text-sm text-gray-500">Start: {{ event.start_date }}</p>
    <p class="text-sm text-gray-500">End: {{ event.end_date }}</p>
    <router-link :to="`/events/${event.id}`" class="mt-2 inline-block text-blue-500">Details</router-link>
  </div>
</template>

<script>
export default {
  name: 'EventCard',
  props: {
    event: Object
  }
};
</script>
