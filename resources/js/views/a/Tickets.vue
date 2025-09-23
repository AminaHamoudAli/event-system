<template>
  <div>
    <Navbar />
    <h1 class="text-2xl font-bold mb-4 mt-4">My Tickets</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <TicketCard v-for="ticket in tickets" :key="ticket.id" :ticket="ticket" />
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import TicketCard from '../components/TicketCard.vue';
import axios from 'axios';

export default {
  components: { Navbar, TicketCard },
  data() {
    return {
      tickets: []
    };
  },
  mounted() {
    axios.get('/my-tickets')
      .then(res => {
        this.tickets = res.data;
      })
      .catch(err => console.error(err));
  }
};
</script>
