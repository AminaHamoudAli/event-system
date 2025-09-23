<template>
  <div class="border rounded p-4 shadow hover:shadow-lg transition cursor-pointer">
    <h3 class="font-bold text-lg">{{ event.title }}</h3>
    <p class="text-gray-700">{{ event.description }}</p>
    <p class="text-sm text-gray-500">Start: {{ event.start_date }}</p>
    <p class="text-sm text-gray-500">End: {{ event.end_date }}</p>
    <inertia-link :href="`/events/${event.id}`" class="text-blue-500 hover:underline">View Details</inertia-link>
  </div>
</template>

<script>
export default {
  props: ['event'],
};
</script>
