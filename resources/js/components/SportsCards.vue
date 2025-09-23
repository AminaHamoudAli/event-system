<template>
  <div class="px-4 py-6">
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <EventCardBox
        v-for="event in cards"
        :key="event.id"
        :event="event"
      />
    </div>
  </div>
</template>

<script>
// import axios from '../vuexios';
import axios from 'axios';
import EventCardBox from './EventCardBox.vue';

export default {
  components: { EventCardBox },
  data() {
    return {
      cards: [],
    };
  },
  mounted() {
    axios
      .get('/getsportsevents')
      .then(response => {
        this.cards = response.data;
      })
      .catch(error => console.log(error.message));
  },
};
</script>

<style scoped></style>
