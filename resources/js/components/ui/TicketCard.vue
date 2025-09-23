<template>
  <div class="border p-3 rounded shadow hover:shadow-lg">
    <h3 class="font-semibold">{{ ticket.ticket_type }} Ticket</h3>
    <p class="text-gray-700">Price: ${{ ticket.price }}</p>
    <p class="text-sm text-gray-500">Status: {{ ticket.status }}</p>
    <button
      :disabled="ticket.status === 'sold'"
      class="mt-2 bg-blue-500 text-white px-4 py-1 rounded disabled:opacity-50"
      @click="buyTicket(ticket.id)"
    >
      Buy
    </button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    ticket: Object
  },
  methods: {
    buyTicket(ticketId) {
      axios.post(`/tickets/${ticketId}/buy`)
        .then(() => {
          alert('Ticket purchased successfully!');
          this.ticket.status = 'sold';
        })
        .catch(err => console.error(err));
    }
  }
};
</script>
