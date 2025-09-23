<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
      <button
        @click="$emit('close')"
        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
      >
        &times;
      </button>

      <h2 class="text-2xl font-bold mb-4">{{ event.title }}</h2>
      <p class="text-gray-700 mb-4">{{ event.description }}</p>

      <form @submit.prevent="bookTicket">
        <div class="mb-4">
          <label class="block mb-1 font-semibold">Ticket Type</label>
          <select v-model="ticketType" class="w-full border rounded p-2">
            <option value="general">General</option>
            <option value="vip">VIP</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="block mb-1 font-semibold">Quantity</label>
          <input type="number" min="1" v-model.number="quantity" class="w-full border rounded p-2" />
        </div>

        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          Confirm Booking
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "EventModal",
  props: {
    show: Boolean,
    event: Object,
  },
  data() {
    return {
      ticketType: "general",
      quantity: 1,
    };
  },
  methods: {
    async bookTicket() {
      try {
        const response = await this.$axios.post("/api/tickets", {
          event_id: this.event.id,
          ticket_type: this.ticketType,
          quantity: this.quantity,
        });

        alert(`Successfully booked ${this.quantity} ticket(s) for ${this.event.title}`);
        this.$emit("close");
      } catch (error) {
        console.error(error);
        alert("Failed to book tickets. Please try again.");
      }
    },
  },
};
</script>


<style scoped></style>
