<template>
  <div class="content px-4 py-6 space-y-6">
    <!-- Header Row -->
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-2"></div>
      <div class="col-span-5">
        <h3 class="text-xl font-semibold">Overview</h3>
      </div>
      <div class="col-span-5">
        <h3 class="text-xl font-semibold">Trending events</h3>
      </div>
    </div>

    <!-- Revenue & Trending Row -->
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-1"></div>
      <div class="col-span-3">
        <RevenueReport />
      </div>
      <div class="col-span-8">
        <Trending />
      </div>
    </div>

    <!-- Event Sales Header -->
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-1"></div>
      <div class="col-span-5">
        <h3 class="text-xl font-semibold">Event sales</h3>
      </div>
      <div class="col-span-5">
        <h3 class="text-xl font-semibold">Ticket sales</h3>
      </div>
    </div>

    <!-- Event & Booking Reports -->
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-1"></div>
      <div class="col-span-5">
        <EventReport />
      </div>
      <div class="col-span-5">
        <BookingReport />
      </div>
    </div>
  </div>
</template>

<script>
import EventReport from '@/components/EventReport.vue';
import Trending from '@/components/Trending.vue';
import RevenueReport from '@/components/RevenueReport.vue';
import BookingReport from '@/components/BookingReport.vue';

export default {
  name: 'Home',
  components: {
    EventReport,
    Trending,
    RevenueReport,
    BookingReport,
  },
};
</script>

<style scoped></style>
