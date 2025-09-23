<template>
  <div class="max-w-xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">إضافة حدث جديد</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label class="block mb-1 font-medium">العنوان</label>
        <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div>
        <label class="block mb-1 font-medium">الموقع</label>
        <input v-model="form.location" type="text" class="w-full border rounded px-3 py-2" required />
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 font-medium">تاريخ البداية</label>
          <input v-model="form.start_date" type="date" class="w-full border rounded px-3 py-2" required />
        </div>
        <div>
          <label class="block mb-1 font-medium">تاريخ النهاية</label>
          <input v-model="form.end_date" type="date" class="w-full border rounded px-3 py-2" required />
        </div>
      </div>

      <div>
        <label class="block mb-1 font-medium">الوصف</label>
        <textarea v-model="form.description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
      </div>

      <div class="flex justify-end gap-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          حفظ الحدث
        </button>
        <button type="button" @click="resetForm" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
          إلغاء
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, toRefs } from 'vue';
import axios from 'axios';
import { emit } from 'vue';

const form = reactive({
  title: '',
  location: '',
  start_date: '',
  end_date: '',
  description: ''
});

// إعادة تعيين الفورم
function resetForm() {
  form.title = '';
  form.location = '';
  form.start_date = '';
  form.end_date = '';
  form.description = '';
}

// إرسال البيانات وحفظ الحدث
async function submitForm() {
  try {
    const res = await axios.post('/api/events', form);

    // إرسال الحدث الجديد للأب لتحديث الجدول مباشرة
    emit('event-added', res.data);

    alert('تم إضافة الحدث بنجاح!');
    resetForm();
  } catch (err) {
    console.error(err.response?.data || err.message);
    alert('حدث خطأ أثناء حفظ الحدث: ' + JSON.stringify(err.response?.data));
  }
}
</script>
