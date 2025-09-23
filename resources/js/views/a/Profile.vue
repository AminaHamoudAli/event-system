<template>
  <div>
    <Navbar />
    <h1 class="text-2xl font-bold mt-4 mb-4">My Profile</h1>
    <div class="p-4 border rounded shadow w-1/2">
      <p><strong>Name:</strong> {{ user.name }}</p>
      <p><strong>Email:</strong> {{ user.email }}</p>
      <p><strong>Role:</strong> {{ user.role }}</p>
    </div>
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import axios from 'axios';

export default {
  components: { Navbar },
  data() {
    return {
      user: {}
    };
  },
  mounted() {
    axios.get('/me')
      .then(res => {
        this.user = res.data;
      })
      .catch(err => console.error(err));
  }
};
</script>
