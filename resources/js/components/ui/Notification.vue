<template>
  <div class="fixed bottom-4 right-4 bg-white p-4 border shadow rounded w-64">
    <h3 class="font-semibold mb-2">Notifications</h3>
    <ul>
      <li v-for="note in notifications" :key="note.id" class="text-gray-700 mb-1">
        {{ note.message }} <span v-if="!note.read_at" class="text-blue-500">(new)</span>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      notifications: []
    };
  },
  mounted() {
    axios.get('/notifications')
      .then(res => {
        this.notifications = res.data;
      })
      .catch(err => console.error(err));
  }
};
</script>
