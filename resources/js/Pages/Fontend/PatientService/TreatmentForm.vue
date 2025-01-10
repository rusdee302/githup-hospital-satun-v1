<template>
    <FontLayout>
      <img
        src="https://www.yash.com/wp-content/uploads/2022/06/hc-new-blogs.jpg"
        alt=""
        class="w-full"
      />
      <div class="container mx-auto">
        <section class="section-3 mt-9 fadeInUp-animation">
          <div class="container mx-auto">
            <div
              class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700"
            >
              <h5
                class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white"
              >
              แบบฟอร์มขอประวัติการรักษา
              </h5>
              <div class="my-8 prose max-w-none" v-html="props.treatment_forms[0].detail"></div>
            </div>
          </div>
        </section>
      </div>
    </FontLayout>
  </template>

  <script setup>
  import FontLayout from "@/Layouts/FontLayout.vue";

  import { Link, useForm } from "@inertiajs/vue3";

  const props = defineProps({
    treatment_forms: Object,
  });


  </script>
