<template>
  <div>
    <Navbar />
    <div v-if="event" class="p-4">
      <h1 class="text-3xl font-bold">{{ event.title }}</h1>
      <p class="mt-2 text-gray-700">{{ event.description }}</p>
      <p class="mt-1 text-sm text-gray-500">Location: {{ event.location }}</p>
      <p class="text-sm text-gray-500">Start: {{ event.start_date }}</p>
      <p class="text-sm text-gray-500">End: {{ event.end_date }}</p>

      <h2 class="text-xl font-semibold mt-4">Tickets</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <TicketCard v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '../components/Navbar.vue';
import TicketCard from '../components/TicketCard.vue';

export default {
  components: { Navbar, TicketCard },
  data() {
    return {
      event: null,
      tickets: [],
    };
  },
  mounted() {
    const eventId = this.$route.params.id;
    axios.get(`/events/${eventId}`)
      .then(res => {
        this.event = res.data.event;
        this.tickets = res.data.tickets;
      })
      .catch(err => console.error(err));
  }
};
</script>
