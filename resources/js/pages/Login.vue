<template>
  <div class="login-form min-h-screen w-full bg-gradient-to-br from-cyan-400 via-blue-900 to-teal-400 flex items-center justify-center">
    <form @submit.prevent="login" class="bg-white p-10 rounded shadow-md w-full max-w-sm text-center relative">
      <h2 class="text-2xl font-bold mb-6">Login</h2>

      <!-- Email -->
      <div class="mb-4">
        <input
          v-model="email"
          type="email"
          placeholder="Email"
          class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <p v-if="email.indexOf('@') < 1 && email.indexOf('.') < 1 && email.length > 0" class="text-red-500 text-sm mt-1 text-left">
          Invalid email ID
        </p>
      </div>

      <!-- Password -->
      <div class="mb-4">
        <input
          v-model="password"
          type="password"
          placeholder="Password"
          class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600 transition">
          Login
        </button>
      </div>
    </form>

    <!-- Success Dialog -->
    <div v-if="active_dialogue" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg text-center">
        <h4 class="text-lg font-bold mb-2">Successfully <b>logged in!</b></h4>
        <img class="mx-auto h-40" src="https://cdn.dribbble.com/users/39201/screenshots/3694057/nutmeg.gif" alt="success" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['isLogged'])
  },
  data() {
    return {
      active_dialogue: false,
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      this.$store
        .dispatch('login', { email: this.email, password: this.password })
        .then(() => {
          if (this.isLogged) {
            this.active_dialogue = true
            setTimeout(() => { this.$router.push({ name: 'Dashboard' }) }, 2000)
          } else {
            alert('Invalid login credentials')
          }
        })
        .catch(err => console.log(err))
    }
  }
}
</script>
