<template>
  <div class="border p-3 rounded shadow">
    <p>Type: {{ ticket.ticket_type }}</p>
    <p>Price: ${{ ticket.price }}</p>
    <p>Status: <span :class="ticket.status === 'available' ? 'text-green-500' : 'text-red-500'">{{ ticket.status }}</span></p>
  </div>
</template>

<script>
export default {
  props: ['ticket'],
};
</script>
