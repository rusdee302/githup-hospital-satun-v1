<template>
  <nav
    class="flex flex-wrap items-center justify-between pt-4 flex-column md:flex-row"
    aria-label="Table navigation"
  >
    <span
      class="block w-full mb-4 text-sm font-normal text-gray-500 dark:text-gray-400 md:mb-0 md:inline md:w-auto"
      >Showing <span class="font-semibold text-gray-900 dark:text-white">{{ datastart }}-{{ (datastart+datacount)-1 }}</span> of
      <span class="font-semibold text-gray-900 dark:text-white">{{ datatotal }}</span></span
    >
    <ul class="inline-flex h-8 -space-x-px text-sm rtl:space-x-reverse">
      <li>
        <Link
          :href="links[0].url"
          class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 ms-0 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >Previous</Link
        >
      </li>
      <div v-for="(link, key) in links">
        <li v-if="key != 0 && key != pageend.P_page">
          <Link
            v-if="link.active"
            :href="link.url"
            class="flex items-center justify-center h-8 px-3 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
            >{{ link.label }}</Link
          >
          <Link
            v-else
            :href="link.url"
            class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >{{ link.label }}</Link
          >
        </li>
      </div>
      <li>
        <Link
          :href="links[pageend.P_next].url"
          class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          >Next</Link
        >
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  links: Array,
  datastart: Object,
  datatotal: Object,
  datacount: Object,
});

const pageend = useForm({
  p_previous: props.links[0],
  P_page: props.links.length - 1,
  P_next: props.links.length - 1,
});
// console.log(pageend.P_next,props.datastart,props.datatotal,props.datacount);
</script>
