<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Upcoming Events</h1>

    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="event in events"
        :key="event.id"
        class="bg-white rounded-lg shadow-md p-5 hover:shadow-xl transition"
      >
        <img
          :src="event.poster || 'https://via.placeholder.com/400x200?text=Event'"
          alt="Event Poster"
          class="rounded-md mb-4 w-full h-48 object-cover"
        />
        <h2 class="text-xl font-semibold mb-2">{{ event.title }}</h2>
        <p class="text-gray-600 text-sm mb-2">{{ event.description }}</p>
        <p class="text-gray-500 text-sm mb-2">
          <span class="font-semibold">Date:</span>
          {{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}
        </p>
        <p class="text-gray-500 text-sm mb-4">
          <span class="font-semibold">Location:</span> {{ event.location || "Online" }}
        </p>
        <button
          @click="openModal(event)"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          Book Ticket
        </button>
      </div>
    </div>

    <EventModal
      v-if="selectedEvent"
      :show="showModal"
      :event="selectedEvent"
      @close="closeModal"
    />
  </div>
</template>

<script>
import EventModal from "../components/EventModal.vue";

export default {
  name: "Events",
  components: { EventModal },
  data() {
    return {
      events: [
        {
          id: 1,
          title: "Music Concert",
          description: "Enjoy an evening of live music and entertainment.",
          start_date: "2025-09-20 19:00",
          end_date: "2025-09-20 22:00",
          location: "City Hall",
          poster: null,
        },
        // الأحداث الأخرى...
      ],
      selectedEvent: null,
      showModal: false,
    };
  },
  methods: {
    formatDate(dateStr) {
      const options = { year: "numeric", month: "short", day: "numeric", hour: "2-digit", minute: "2-digit" };
      return new Date(dateStr).toLocaleDateString("en-US", options);
    },
    openModal(event) {
      this.selectedEvent = event;
      this.showModal = true;
    },
    closeModal() {
      this.selectedEvent = null;
      this.showModal = false;
    },
  },
};
</script>
