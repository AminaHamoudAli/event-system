<template>
  <div>
    <Navbar />
    <h2 class="text-2xl font-bold">{{ event.title }}</h2>
    <p>{{ event.description }}</p>
    <p>Location: {{ event.location }}</p>
    <FileList :files="event.files" />
    <h3 class="mt-4 text-xl font-bold">Tickets</h3>
    <div class="grid grid-cols-2 gap-4 mt-2">
      <TicketCard v-for="ticket in event.tickets" :key="ticket.id" :ticket="ticket" />
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import TicketCard from '../components/TicketCard.vue';
import FileList from '../components/FileList.vue';

export default {
  props: { event: Object },
  components: { Navbar, TicketCard, FileList },
};
</script>
