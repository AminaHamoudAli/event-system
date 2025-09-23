<template>
  <div class="home p-4">
    <!-- Main container -->
    <div class="new-event max-w-6xl mx-auto relative bg-white p-10 rounded shadow-lg">
      
      <!-- Event Image -->
      <div v-if="event_data.e_image_url" class="w-full h-64 mb-6 rounded-lg bg-center bg-cover" :style="{ backgroundImage: `url(${event_data.e_image_url})` }"></div>
      
      <!-- Event Details and Tickets -->
      <div class="flex flex-wrap -mx-4">
        
        <!-- Event Details -->
        <div class="w-full lg:w-7/12 px-4 mb-6 lg:mb-0">
          <h2 class="text-2xl font-bold mb-2">{{ event_data.e_name }}</h2>
          <p class="text-gray-600">{{ event_data.e_location }}</p>
          <p class="text-gray-600">{{ event_data.e_date }}</p>
          <p class="text-gray-600">{{ event_data.e_organizer }}</p>
          <p class="mt-4">{{ event_data.e_desc }}</p>

          <div class="flex mt-6 gap-4">
            <router-link :to="{ name: 'EditEvent', params: { id: event_id } }">
              <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit event</button>
            </router-link>
            <button @click="delete_confirm = true" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete event</button>
          </div>
        </div>
<AddEventForm @event-added="events.push($event)" />

        <!-- Ticket Purchase -->
        <div class="w-full lg:w-5/12 px-4">
          <form @submit.prevent="pushOrderData" class="bg-gray-50 p-6 rounded shadow">
            <h3 class="text-xl font-semibold mb-4">Buy tickets</h3>

            <input v-model="c_name" placeholder="Name" type="text" class="w-full mb-3 p-2 border rounded" />
            <input v-model="c_email" placeholder="Email" type="email" class="w-full mb-3 p-2 border rounded" />
            <input v-model="c_phone" placeholder="Phone" type="number" class="w-full mb-3 p-2 border rounded" />
            <input v-model="c_t_no" placeholder="Number of tickets" type="number" class="w-full mb-3 p-2 border rounded" />

            <!-- Ticket Type -->
            <div v-if="event_data.t_type" class="flex gap-4 my-3">
              <label class="flex items-center gap-2">
                <input type="radio" v-model="t_select_type" value="1" /> Silver
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" v-model="t_select_type" value="2" /> Gold
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" v-model="t_select_type" value="3" /> Platinum
              </label>
            </div>

            <h4 class="mb-3">Total cost: {{ total_cost }}</h4>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Place order</button>
          </form>
        </div>

      </div>
    </div>

    <!-- Dialogs -->
    <div v-if="active_dialogue" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg text-center">
        <h4 class="text-lg font-bold mb-2">Order placed <b>successfully!</b></h4>
        <img class="mx-auto h-40" src="https://cdn.dribbble.com/users/2173054/screenshots/8143107/media/d5e2d1d137f0e7c374d66dd339d9b184.gif" alt="success" />
      </div>
    </div>

    <div v-if="delete_confirm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg text-center w-80">
        <h5 class="text-lg font-bold mb-2">Delete event</h5>
        <img class="mx-auto h-40 mb-2" src="https://cdn.dribbble.com/users/295355/screenshots/3550054/junkloader.gif" alt="delete" />
        <h4 class="mb-4">Are you sure you want to delete this event?</h4>
        <div class="flex justify-center gap-4">
          <button @click="deleteEvent()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
          <button @click="delete_confirm = false" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
        </div>
      </div>
    </div>

    <div v-if="delete_dialogue" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg text-center">
        <h4 class="text-lg font-bold mb-2">Event deleted <b>successfully!</b></h4>
        <img class="mx-auto h-40" src="https://cdn.dribbble.com/users/592004/screenshots/2953817/___.gif" alt="deleted" />
      </div>
    </div>

  </div>
</template>

<script>
// import axios from '../vuexios';

import axios from 'axios'
export default {
  data() {
    return {
      active: 1,
      active_dialogue: false,
      delete_dialogue: false,
      delete_confirm: false,
      event_id: null,
      event_data: [],
      c_name: '',
      c_email: '',
      c_phone: '',
      t_select_type: '0',
      c_t_no: 1,
      n: 0,
      s: 0,
      g: 0,
      p: 0,
      total_cost: 0,
    };
  },
  created() {
    this.event_id = this.$route.params.id;
  },
  mounted() {
    axios
      .get('/geteventdata/' + this.event_id)
      .then(response => {
        this.event_data = response.data;
        this.assignValues(this.event_data);
      })
      .catch(error => console.log(error.message));
  },
  methods: {
    deleteEvent() {
      axios.delete('/deleteevent/' + this.event_id).catch(err => console.log(err));
      this.delete_confirm = false;
      this.delete_dialogue = true;
      setTimeout(() => this.$router.push({ name: 'Dashboard' }), 3500);
    },
    pushOrderData() {
      const content = {
        c_name: this.c_name,
        c_email: this.c_email,
        c_phone: this.c_phone,
        event_id: this.event_id,
        t_type: parseInt(this.t_select_type),
        no_of_tickets: this.c_t_no,
        total_cost: this.total_cost,
      };
      axios
        .post('/createnewticket', content)
        .then(response => this.active_dialogue = true)
        .then(() => setTimeout(() => this.$router.push({ name: 'Dashboard' }), 2000))
        .catch(err => console.log(err));
    },
    assignValues(data) {
      this.n = data.n_val;
      this.s = data.s_val;
      this.g = data.g_val;
      this.p = data.p_val;
    },
    calculateCost(eData) {
      if (eData.t_type === 0) this.total_cost = this.c_t_no * eData.n_val;
      else {
        if (this.t_select_type === null) this.total_cost = 0;
        else if (this.t_select_type === '1') this.total_cost = this.c_t_no * eData.s_val;
        else if (this.t_select_type === '2') this.total_cost = this.c_t_no * eData.g_val;
        else if (this.t_select_type === '3') this.total_cost = this.c_t_no * eData.p_val;
      }
    },
  },
};
</script>
