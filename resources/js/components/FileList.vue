<template>
  <div>
    <h4 class="font-bold mb-2">Files</h4>
    <ul>
      <li v-for="file in files" :key="file.id">
        <a :href="`/storage/${file.file_path}`" target="_blank">{{ file.file_type }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['files'],
};
</script>

