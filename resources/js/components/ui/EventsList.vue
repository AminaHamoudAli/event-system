<template>
  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">📅 قائمة الفعاليات</h1>

    <!-- حالة التحميل -->
    <div v-if="loading" class="text-center text-gray-500">
      جاري تحميل البيانات...
    </div>

    <!-- في حال عدم وجود بيانات -->
    <div v-else-if="events.length === 0" class="text-center text-gray-500">
      لا توجد فعاليات حالياً
    </div>

    <!-- عرض البطاقات -->
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="event in events" :key="event.id"
           class="bg-white shadow-md rounded-lg p-5 hover:shadow-xl transition">
        <h2 class="text-xl font-semibold text-blue-600 mb-2">{{ event.title }}</h2>
        <p class="text-gray-700 mb-3">{{ event.description }}</p>

        <div class="text-sm text-gray-500">
          <p><strong>📍 الموقع:</strong> {{ event.location }}</p>
          <p><strong>🗓️ من:</strong> {{ formatDate(event.start_date) }}</p>
          <p><strong>🗓️ إلى:</strong> {{ formatDate(event.end_date) }}</p>
          <p><strong>👤 المنظم:</strong> {{ event.organizer?.name }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
axios.get("/api/events") // هذا صحيح


export default {
  name: "EventList",
  data() {
    return {
      events: [],
      loading: true,
    };
  },
  mounted() {
    axios.get("/api/events")
      .then(response => {
        this.events = response.data;
      })
      .catch(error => {
        console.error("خطأ في جلب البيانات:", error);
      })
      .finally(() => {
        this.loading = false;
      });
  },
  methods: {
    formatDate(date) {
      return new Date(date).toLocaleDateString("ar-EG", {
        year: "numeric", month: "long", day: "numeric"
      });
    }
  }
};
</script>
