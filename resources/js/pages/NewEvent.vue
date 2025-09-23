<template>
  <div class="create-event-content flex flex-wrap overflow-hidden min-h-screen">
    <!-- Form Section -->
    <div class="w-full lg:w-2/3 p-4 overflow-auto relative">
      <div class="new-event bg-white p-10 rounded shadow-lg">
        <form @submit.prevent="pushData">
          <h2 class="text-2xl font-bold mb-4">Create new event</h2>
          <p class="mb-4">The live preview of the event card will show on the sidebar!</p>

          <!-- Event Title -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">Event title</label>
            <div class="w-2/3">
              <input
                v-model="e_title"
                type="text"
                placeholder="Event title"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <p v-if="e_title.length < 3 && e_title.length > 0" class="text-red-500 text-sm mt-1">
                Name should be more than 3 letters long
              </p>
            </div>
          </div>

          <!-- Organizer -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">Organizer</label>
            <div class="w-2/3">
              <input
                v-model="e_organizer"
                type="text"
                placeholder="Organizer"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Date -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">Date</label>
            <div class="w-2/3">
              <input
                v-model="e_date"
                type="date"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Category & Duration -->
          <div class="flex mb-4 flex-wrap">
            <label class="w-1/4 pt-3">Category</label>
            <select v-model="e_catagory" class="w-1/4 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 mr-4">
              <option value="" disabled>Select</option>
              <option value="fun">Fun</option>
              <option value="sports">Sports</option>
            </select>

            <label class="w-1/4 pt-3">Duration(days)</label>
            <input
              v-model="e_duration"
              type="number"
              placeholder="Days"
              class="w-1/4 p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <!-- Location -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">Location</label>
            <div class="w-2/3">
              <input
                v-model="e_location"
                type="text"
                placeholder="Location"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Cover Image -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">Cover Image URL</label>
            <div class="w-2/3">
              <input
                v-model="previewImage"
                type="text"
                placeholder="Image URL"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          <!-- Description -->
          <div class="flex mb-4">
            <label class="w-1/3 pt-3">More details</label>
            <div class="w-2/3">
              <textarea
                v-model="e_desc"
                rows="3"
                placeholder="Description about the event..."
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
              ></textarea>
            </div>
          </div>

          <!-- Ticket Type -->
          <div class="flex mb-4 items-center">
            <label class="w-1/4 pt-3">Ticket type</label>
            <div class="w-1/6">
              <input type="checkbox" v-model="t_type" class="toggle-checkbox"/>
              <span class="ml-2">{{ t_type ? 'Premium' : 'Normal' }}</span>
            </div>
            <div class="w-1/2 text-sm text-gray-500">
              *Select premium option for advanced pricing
            </div>
          </div>

          <!-- Ticket Prices -->
          <div class="flex flex-wrap mb-6">
            <!-- Normal Price -->
            <div v-if="!t_type" class="w-1/4 p-2">
              <div class="border p-2 text-center rounded bg-blue-100">
                <h4 class="font-bold">Normal</h4>
                <input v-model="n_price" type="number" placeholder="Price" class="w-full mt-2 p-1 border rounded"/>
              </div>
            </div>

            <!-- Premium Prices -->
            <div v-if="t_type" class="w-1/4 p-2" v-for="(price, idx) in ['s_price','g_price','p_price']" :key="idx">
              <div :class="[
                  'border p-2 text-center rounded',
                  idx===0 ? 'bg-gray-200' : idx===1 ? 'bg-yellow-400 text-white' : 'bg-gray-800 text-white'
                ]">
                <h4 class="font-bold">{{ idx===0 ? 'Silver' : idx===1 ? 'Gold' : 'Platinum' }}</h4>
                <input v-model="price.value" type="number" placeholder="Price" class="w-full mt-2 p-1 border rounded"/>

                <!-- <input v-model="priceValue(price)" type="number" placeholder="Price" class="w-full mt-2 p-1 border rounded"/> -->
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
              Create event
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Card Preview Section -->
    <div class="w-full lg:w-1/3 p-4">
      <div class="event-card bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-bold mb-4">Card preview</h2>
        <div class="border rounded overflow-hidden">
          <img :src="previewImage || default_img" alt="" class="w-full h-48 object-cover"/>
          <div class="p-4">
            <h3 class="text-lg font-semibold">{{ e_title }}</h3>
            <p class="text-sm text-gray-700 overflow-hidden line-clamp-2">{{ e_desc }}</p>
            <div class="flex justify-between mt-4">
              <button class="bg-blue-200 p-2 rounded" v-if="t_type">💰</button>
              <button class="bg-gray-200 p-2 rounded" v-else>💰</button>
              <button class="bg-blue-500 text-white p-2 rounded flex items-center">
                📅 <span class="ml-2">{{ e_date }}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Success Dialog -->
    <div v-if="active_dialogue" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow-lg text-center">
        <h4 class="text-lg font-bold mb-2">Event created<b> successfully!</b></h4>
        <img
          class="mx-auto h-40"
          src="https://cdn.dribbble.com/users/2173054/screenshots/8143107/media/d5e2d1d137f0e7c374d66dd339d9b184.gif"
          alt=""
        />
      </div>
    </div>
  </div>
</template>

<script>
// import axios from '../vuexios';
import axios from 'axios'



export default {
  data() {
    return {
      active_dialogue: false,
      previewImage: 'https://www1.chester.ac.uk/sites/default/files/styles/hero_mobile/public/Music-Production-and-Promotion_0.jpg?itok=AMRG5XBn',
      e_title: '',
      e_desc: '',
      e_organizer: '',
      e_location: '',
      e_duration: 0,
      e_catagory: '',
      e_date: null,
      t_type: false,
      n_price: 0,
      s_price: 0,
      g_price: 0,
      p_price: 0,
      message: '',
      default_img: 'https://via.placeholder.com/400x250?text=Event+Image'
    };
  },
  methods: {
    priceValue(prop) {
      return {
        get: () => this[prop],
        set: val => this[prop] = val
      };
    },
    pushData() {
      if (!this.t_type && !this.n_price) { alert('Enter the normal price.'); return; }
      if (this.t_type && (!this.s_price || !this.g_price || !this.p_price)) { alert('Enter the Silver, Gold, and Platinum price.'); return; }

      const content = {
        e_name: this.e_title,
        e_desc: this.e_desc,
        e_organizer: this.e_organizer,
        e_catagory: this.e_catagory,
        e_location: this.e_location,
        e_duration: this.e_duration,
        e_date: this.e_date,
        t_type: this.t_type,
        normal: this.n_price,
        silver: this.s_price,
        gold: this.g_price,
        platinum: this.p_price,
        e_image_url: this.previewImage,
      };
      console.log(content);
      axios.post('/createnewevent', content)
        .then(res => { this.message = res.data.message; })
        .then(() => {
          this.active_dialogue = true;
          setTimeout(() => this.$router.push({ name: 'Dashboard' }), 2000);
        })
        .catch(err => { alert('All fields are required!'); console.log(err); });
    }
  }
};
</script>
