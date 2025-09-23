<template>
  <div class="home p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow relative">
      <!-- صورة الحدث -->
      <div v-if="event_data.e_image_url" class="w-full h-64 bg-cover bg-center rounded mb-6"
           :style="{ backgroundImage: `url(${event_data.e_image_url})` }">
      </div>

      <h2 class="text-2xl font-bold mb-2">{{ event_data.e_name }}</h2>
      <p class="mb-6">Edit the details of this event</p>

      <form @submit.prevent="pushEditData" class="space-y-4">
        <!-- Organizer -->
        <div class="flex items-center">
          <span class="w-32 font-semibold">Organizer:</span>
          <input v-model="event_data.e_organizer" type="text" class="flex-1 border rounded px-3 py-2" />
        </div>

        <!-- Date & Duration -->
        <div class="flex items-center space-x-4">
          <div class="flex items-center">
            <span class="w-32 font-semibold">Date:</span>
            <input v-model="event_data.e_date" type="date" class="border rounded px-3 py-2" />
          </div>
          <div class="flex items-center">
            <span class="w-32 font-semibold">Duration (days):</span>
            <input v-model="event_data.e_duration" type="number" min="1" class="border rounded px-3 py-2 w-20" />
          </div>
        </div>

        <!-- Location -->
        <div class="flex items-center">
          <span class="w-32 font-semibold">Location:</span>
          <input v-model="event_data.e_location" type="text" class="flex-1 border rounded px-3 py-2" />
        </div>

        <!-- Cover Image URL -->
        <div class="flex items-center">
          <span class="w-32 font-semibold">Cover Image URL:</span>
          <input v-model="event_data.e_image_url" type="text" class="flex-1 border rounded px-3 py-2" />
        </div>

        <!-- Description -->
        <div class="flex flex-col">
          <span class="w-32 font-semibold mb-1">More details:</span>
          <textarea v-model="event_data.e_desc" rows="4" class="border rounded px-3 py-2"></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
          Edit Event
        </button>
      </form>

      <!-- Dialog -->
      <div v-if="active_dialogue" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg text-center">
          <h4 class="text-lg font-bold mb-4">Event edited <span class="text-green-600">successfully!</span></h4>
          <img class="mx-auto max-h-40" src="https://cdn.dribbble.com/users/2173054/screenshots/8143107/media/d5e2d1d137f0e7c374d66dd339d9b184.gif" alt="Success"/>
        </div>
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
      active_dialogue: false,
      event_id: null,
      event_data: {},
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
      })
      .catch(error => console.log(error.message));
  },
  methods: {
    pushEditData() {
      const content = {
        id: this.event_id,
        e_desc: this.event_data.e_desc,
        e_organizer: this.event_data.e_organizer,
        e_location: this.event_data.e_location,
        e_duration: this.event_data.e_duration,
        e_date: this.event_data.e_date,
        e_image_url: this.event_data.e_image_url,
      };
      axios
        .post('/editeventalt', content)
        .then(() => {
          this.active_dialogue = true;
          setTimeout(() => this.$router.push({ name: 'Dashboard' }), 2000);
        })
        .catch(err => console.log(err));
    },
  },
};
</script>

<style scoped>
.home {
  min-height: 100vh;
  background-color: #f3f4f6;
}
</style>
