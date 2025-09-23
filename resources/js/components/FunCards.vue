<template>
  <div class="p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <EventCardBox
        v-for="event in cards"
        :key="event.id || event.e_name"
        :event="event"
      />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
// import axios from '../vuexios';
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
      .get('/getfunevents')
      .then(response => {
        this.cards = response.data;
      })
      .catch(error => console.log(error.message));
  },
};
</script>

<style scoped>
/* يمكنك إضافة أي تعديلات خاصة بالبطاقات هنا */
</style>
