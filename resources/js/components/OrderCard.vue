<template>
  <div class="border p-3 rounded shadow">
    <p>Ticket: {{ order.ticket.ticket_type }}</p>
    <p>Quantity: {{ order.quantity }}</p>
    <p>Total: ${{ order.total }}</p>
    <p>User: {{ order.user.name }}</p>
  </div>
</template>

<script>
export default {
  props: ['order'],
};
</script>
