

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
          <div class="mt-5 text-center">
            <p
              class="text-2xl font-semibold leading-normal text-center text-gray-900 dark:text-white"
            >
              {{ titlenews[0] }}
            </p>
            <div class="">
              <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
            </div>
          </div>
          <div class="mt-5">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
              <div v-for="Newss in Newsdb" :key="Newss.id" class="w-full">
                <Link
                  :href="route('News.Press_Release_detail', Newss.id)"
                  class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                <div>
                  <span class="w-8 text-center">
                    <p class="text-2xl">{{ Newss.created_at }}</p>
                  </span>
                  <hr>
                  <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5
                      class="mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white cus_showtext_1 line-clamp-2"
                    >
                      {{ Newss.News_title }}
                    </h5>
                    <p
                      class="mb-3 font-normal text-gray-700 dark:text-gray-400 cus_showtext line-clamp-2"
                    >
                      {{ Newss.News_detail }}
                    </p>
                  </div>
                </div>
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </FontLayout>
</template>

<script setup>
import FontLayout from "@/Layouts/FontLayout.vue";

import { Link } from "@inertiajs/vue3";

defineProps({
  Newsdb: Object,
  titlenews: Object,
});


</script>


