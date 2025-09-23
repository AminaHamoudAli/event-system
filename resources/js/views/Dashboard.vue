<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside
      :class="{'-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
      class="fixed md:static z-30 inset-y-0 left-0 w-64 bg-blue-600 text-white transform transition-transform duration-300 ease-in-out"
    >
      <div class="flex flex-col h-full py-7 px-4">
        <div class="flex items-center justify-between mb-8">
          <h1 class="text-2xl font-bold">Event System</h1>
          <!-- زر الإغلاق على الموبايل -->
          <button @click="sidebarOpen = false" class="md:hidden text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <nav class="flex-1 space-y-2">
          <router-link to="/" class="flex items-center px-4 py-2 rounded hover:bg-blue-500" @click="closeSidebarOnMobile">
            <span class="material-icons mr-2">dashboard</span>
            Dashboard
          </router-link>
          <router-link to="/events" class="flex items-center px-4 py-2 rounded hover:bg-blue-500" @click="closeSidebarOnMobile">
            <span class="material-icons mr-2">event</span>
            Events
          </router-link>
          <router-link to="/new-event" class="flex items-center px-4 py-2 rounded hover:bg-blue-500" @click="closeSidebarOnMobile">
            <span class="material-icons mr-2">add_circle</span>
            New Event
          </router-link>
          <router-link to="/reports" class="flex items-center px-4 py-2 rounded hover:bg-blue-500" @click="closeSidebarOnMobile">
            <span class="material-icons mr-2">analytics</span>
            Reports
          </router-link>
          <router-link to="/login" class="flex items-center px-4 py-2 rounded hover:bg-blue-500" @click="closeSidebarOnMobile">
            <span class="material-icons mr-2">login</span>
            Login
          </router-link>
        </nav>
      </div>
    </aside>

    <!-- Overlay على الهواتف -->
    <div v-if="sidebarOpen" class="fixed inset-0 bg-black opacity-50 z-20 md:hidden" @click="sidebarOpen = false"></div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar أعلى المحتوى للهواتف -->
      <header class="bg-white shadow-md md:hidden flex items-center justify-between px-4 py-3">
        <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
        <button @click="sidebarOpen = true" class="text-gray-800 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </header>

      <main class="p-6 overflow-auto">
        <!-- Cards الإحصائيات -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Total Events</h3>
            <p class="text-gray-600">{{ events.length }}</p>
          </div>
          <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Total Tickets</h3>
            <p class="text-gray-600">245</p>
          </div>
          <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">Total Orders</h3>
            <p class="text-gray-600">87</p>
          </div>
        </div>

        <!-- جدول مختصر للأحداث -->
        <div class="mt-8 bg-white rounded shadow p-4 overflow-auto">
          <h3 class="text-xl font-semibold mb-4">Recent Events</h3>
          <table class="w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="border-b px-4 py-2">Event</th>
                <th class="border-b px-4 py-2">Start Date</th>
                <th class="border-b px-4 py-2">Location</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="event in events" :key="event.id" class="hover:bg-gray-100">
                <td class="border-b px-4 py-2">{{ event.title }}</td>
                <td class="border-b px-4 py-2">{{ event.start_date }}</td>
                <td class="border-b px-4 py-2">{{ event.location }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      sidebarOpen: false,
      events: [
        { id: 1, title: "Concert", start_date: "2025-10-07", location: "Robertstown" },
        { id: 2, title: "Workshop", start_date: "2025-10-15", location: "New York" },
        { id: 3, title: "Conference", start_date: "2025-10-22", location: "London" },
      ],
    };
  },
  methods: {
    closeSidebarOnMobile() {
      if (window.innerWidth < 768) {
        this.sidebarOpen = false;
      }
    }
  }
};
</script>

<style scoped>
/* أيقونات Material */
@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
</style>
