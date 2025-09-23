<template>
  <div class="my-page">
    <h1>مرحبا بك في MyPage.vue!</h1>
    <p>هذا محتوى الصفحة يظهر الآن بشكل صحيح بدون أي مكتبات إضافية.</p>
  </div>
</template>

<script setup>
// لا نستخدم أي مكتبات خارجية هنا
</script>

<style scoped>
.my-page {
  padding: 2rem;
  background-color: #f3f3f3;
  border-radius: 8px;
}

.my-page h1 {
  color: #1d4ed8; /* أزرق */
  margin-bottom: 1rem;
}

.my-page p {
  font-size: 1.1rem;
  color: #374151; /* رمادي داكن */
}
</style>
