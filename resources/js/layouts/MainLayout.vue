<template>
  <div class="flex flex-col min-h-screen">
    <div class="flex flex-1">
      <Sidebar />
      <main class="flex-1 overflow-auto p-6">
        <slot />
      </main>
    </div>
    <Footer />
  </div>
</template>


<script>
import Sidebar from '../components/Sidebar.vue';
import Footer from '../components/Footer.vue';

export default {
  components: {
    Sidebar,
    Footer,
  },
};
</script>

<style scoped>
/* Scrollbar لطيف لمحتوى الـ main */
main::-webkit-scrollbar {
  width: 8px;
}
main::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 4px;
}
</style>
