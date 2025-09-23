<template>
  <div>
    <Navbar />
    <h1 class="text-2xl font-bold mb-4 mt-4">All Events</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <EventCard v-for="event in events" :key="event.id" :event="event" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '../components/Navbar.vue';
import EventCard from '../components/EventCard.vue';

export default {
  components: { Navbar, EventCard },
  data() {
    return {
      events: []
    };
  },
  mounted() {
    axios.get('/events')
      .then(res => {
        this.events = res.data;
      })
      .catch(err => console.error(err));
  }
};
</script>
