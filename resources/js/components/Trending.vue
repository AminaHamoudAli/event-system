<!-- <template>
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
import axios from '../vuexios';
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
      .get('/gettrendingevents')
      .then(response => {
        this.cards = response.data;
      })
      .catch(error => console.log(error.message));
  },
};
</script>

<style scoped></style> -->
<template>
  <div>
    <b-row>
      <b-col>
        <vs-card-group>
          <EventCardBox
            v-for="event in cards"
            :key="event.event_id"
            :event="event"
          />
        </vs-card-group>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import EventCardBox from './EventCardBox.vue';

export default {
  components: { EventCardBox },
  data() {
    return {
      cards: [
        {
          event_id: 1,
          e_name: 'Music Festival',
          e_image_url: 'https://via.placeholder.com/400x250',
          e_desc: 'Enjoy a fun-filled music festival!',
          e_location: 'New York',
          t_type: true,
          total_revenue: 1200,
          total_sold: 50,
          e_date: '2025-10-01'
        },
        {
          event_id: 2,
          e_name: 'Sports Event',
          e_image_url: 'https://via.placeholder.com/400x250',
          e_desc: 'Exciting sports matches.',
          e_location: 'Los Angeles',
          t_type: false,
          total_revenue: 500,
          total_sold: 30,
          e_date: '2025-11-15'
        }
      ]
    };
  }
};
</script>
