<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <div 
      v-for="card in cards" 
      :key="card.title" 
      :class="['p-6 rounded-lg shadow-lg text-white transition-transform duration-300 hover:scale-105', card.color]"
    >
      <h2 class="text-xl font-semibold">{{ card.title }}</h2>
      <p class="text-3xl font-bold mt-2">{{ card.value }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cards: Array
  }
}
</script>
