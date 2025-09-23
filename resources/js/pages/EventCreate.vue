<template>
  <MainLayout>
    <div class="p-6 space-y-6">
      <h1 class="text-3xl font-bold text-gray-800">
        {{ isEdit ? 'تعديل الحدث' : 'إضافة حدث جديد' }}
      </h1>

      <form @submit.prevent="submitEvent" class="bg-white shadow rounded-lg p-6 space-y-4">
        <!-- عنوان الحدث -->
        <div>
          <label class="block text-gray-700">عنوان الحدث</label>
          <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2">
          <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title[0] }}</p>
        </div>

        <!-- وصف الحدث -->
        <div>
          <label class="block text-gray-700">الوصف</label>
          <textarea v-model="form.description" class="w-full border rounded px-3 py-2"></textarea>
          <p v-if="errors.description" class="text-red-500 text-sm">{{ errors.description[0] }}</p>
        </div>

        <!-- الموقع -->
        <div>
          <label class="block text-gray-700">الموقع</label>
          <input v-model="form.location" type="text" class="w-full border rounded px-3 py-2">
          <p v-if="errors.location" class="text-red-500 text-sm">{{ errors.location[0] }}</p>
        </div>

        <!-- تاريخ البداية والنهاية -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-gray-700">تاريخ البداية</label>
            <input v-model="form.start_date" type="date" class="w-full border rounded px-3 py-2">
            <p v-if="errors.start_date" class="text-red-500 text-sm">{{ errors.start_date[0] }}</p>
          </div>
          <div>
            <label class="block text-gray-700">تاريخ النهاية</label>
            <input v-model="form.end_date" type="date" class="w-full border rounded px-3 py-2">
            <p v-if="errors.end_date" class="text-red-500 text-sm">{{ errors.end_date[0] }}</p>
          </div>
        </div>

        <!-- رفع الملفات -->
        <div>
          <label class="block text-gray-700">رفع ملفات الحدث (صور / PDF)</label>
          <input type="file" @change="handleFileUpload" multiple class="w-full border rounded px-3 py-2">
          <p v-if="errors.files" class="text-red-500 text-sm">{{ errors.files[0] }}</p>
        </div>

        <!-- زر الحفظ -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          {{ isEdit ? 'تحديث الحدث' : 'إنشاء الحدث' }}
        </button>
      </form>
    </div>
  </MainLayout>
</template>

<script>
import axios from 'axios';
import MainLayout from '../layouts/MainLayout.vue';
import { useRoute } from '@inertiajs/vue3';

export default {
  components: { MainLayout },
  setup() {
    const route = useRoute();
    const isEdit = !!route.params.id; // إذا كان هناك id يعني تعديل
    return { isEdit, route };
  },
  data() {
    return {
      form: {
        title: '',
        description: '',
        location: '',
        start_date: '',
        end_date: '',
        files: []
      },
      errors: {}
    };
  },
  mounted() {
    if (this.isEdit) this.loadEvent();
  },
  methods: {
    handleFileUpload(e) {
      this.form.files = Array.from(e.target.files);
    },
    async loadEvent() {
      const res = await axios.get(`/api/events/${this.route.params.id}`);
      this.form = { ...res.data, files: [] };
    },
    async submitEvent() {
      try {
        const formData = new FormData();
        for (const key in this.form) {
          if (key === 'files') {
            this.form.files.forEach(file => formData.append('files[]', file));
          } else {
            formData.append(key, this.form[key]);
          }
        }

        if (this.isEdit) {
          await axios.post(`/api/events/${this.route.params.id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
          });
          alert('تم تحديث الحدث بنجاح');
        } else {
          await axios.post('/api/events', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
          });
          alert('تم إنشاء الحدث بنجاح');
        }

        window.location.href = '/events';
      } catch (err) {
        if (err.response?.data?.errors) {
          this.errors = err.response.data.errors;
        }
      }
    }
  }
};
</script>
