<script setup>
const props = defineProps({
  number: String,
  title: String,
});
</script>

<template>
  <div class="flex items-center justify-center rounded h-50 bg-gray-50 dark:bg-gray-800">
    <div
      class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
      <div class="flex flex-col items-center pb-10">
        <h5 class="mt-5 mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ number }}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ title }}</span>
      </div>
    </div>
  </div>
</template>
