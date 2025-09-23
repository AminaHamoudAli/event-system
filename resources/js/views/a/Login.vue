<!-- resources/js/views/Login.vue -->
<template>
  <div class="login-page">
    <h1>Login</h1>
    <form>
      <label for="email">Email:</label>
      <input type="email" id="email" />

      <label for="password">Password:</label>
      <input type="password" id="password" />

      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      // من هنا رح تستدعي الـ API لتسجيل الدخول
      console.log("Logging in with:", this.email, this.password);
    },
  },
};
</script>

<style scoped>
.login-page {
  max-width: 400px;
  margin: auto;
  padding: 2rem;
  border: 1px solid #ddd;
  border-radius: 8px;
}
.login-page input {
  display: block;
  width: 100%;
  margin-bottom: 1rem;
  padding: 0.5rem;
}
</style>
