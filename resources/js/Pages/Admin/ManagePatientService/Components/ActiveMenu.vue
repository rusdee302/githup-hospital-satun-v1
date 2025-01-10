<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
});

const classes = computed(() =>
  props.active
    ? "p-6  border border-gray-200 rounded-lg shadow hover:bg-green-400 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 bg-green-400"
    : "p-6 bg-slate-100 border border-gray-200 rounded-lg shadow hover:bg-green-400 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
);
</script>

<template>
    <Link
       :href="href" :class="classes"
      >
        <p class="flex flex-col items-center font-bold tracking-tight text-gray-900 dark:text-white">
            <slot />
        </p>
      </Link>
</template>
