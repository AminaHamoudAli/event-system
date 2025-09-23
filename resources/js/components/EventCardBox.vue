<template>
  <div class="p-4">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
      <div
        v-for="event in events"
        :key="event.event_id"
        class="bg-white rounded-lg shadow-lg overflow-hidden"
      >
        <!-- عنوان الحدث -->
        <router-link
          :to="{ name: 'Event', params: { id: event.event_id } }"
          class="block px-4 py-2 hover:text-blue-700"
        >
          <h3 class="text-xl font-semibold">{{ event.e_name }}</h3>
        </router-link>

        <!-- صورة الحدث -->
        <router-link
          :to="{ name: 'Event', params: { id: event.event_id } }"
        >
          <img
            :src="event.e_image_url"
            alt=""
            class="w-full object-cover min-h-[250px]"
          />
        </router-link>

        <!-- وصف وموقع الحدث -->
        <div class="px-4 py-2">
          <p class="text-gray-600">{{ event.e_location }}</p>
          <p class="text-gray-700 overflow-hidden line-clamp-2">
            {{ event.e_desc }}
          </p>
        </div>

        <!-- الأزرار التفاعلية -->
        <div class="px-4 py-2 flex flex-wrap gap-2">
          <button
            v-if="event.t_type"
            class="flex items-center bg-yellow-400 text-white px-3 py-1 rounded shadow"
          >
            <i class="bx bx-dollar-circle mr-1"></i>
            <span>{{ event.total_revenue }}</span>
          </button>

          <button
            v-if="!event.t_type"
            class="flex items-center bg-gray-200 text-gray-800 px-3 py-1 rounded shadow"
          >
            <i class="bx bx-dollar-circle mr-1"></i>
            <span>{{ event.total_revenue }}</span>
          </button>

          <button
            class="flex items-center bg-green-500 text-white px-3 py-1 rounded shadow"
          >
            <i class="bx bx-purchase-tag-alt mr-1"></i>
            <span>{{ event.total_sold }}</span>
          </button>

          <button
            class="flex items-center bg-blue-500 text-white px-3 py-1 rounded shadow"
          >
            <box-icon name="calendar" class="mr-1"></box-icon>
            <span>{{ event.e_date }}</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EventCardBox',
  props: ['event'],
};
</script>

<!-- <style scoped>
/* دعم tailwind line-clamp */
@layer utilities {
  .line-clamp-2 {
    display: -webkit-box;
    /* -webkit-line-clamp: 2; */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
</style> -->
