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
              {{ title[0] }}
            </p>
            <div class="">
              <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
            </div>
          </div>
          <div class="mt-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-5">
              <Link
                :href="
                  route(
                    'InterestingInformation.InterestingInformation_detail',
                    datadb_show.id
                  )
                "
                class="w-full"
                v-for="datadb_show in datadb"
                :key="datadb_show.id"
              >
                <div
                  class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                >
                  <img
                    class="object-cover h-48 rounded-t-lg w-96"
                    :src="datadb_show.interestingInformation_title_image"
                    alt=""
                  />
                  <div class="p-5">
                    <h5
                      class="mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white cus_showtext line-clamp-2"
                    >
                      {{ datadb_show.interestingInformation_title }}
                    </h5>
                    <p
                      class="mb-3 font-normal text-gray-700 dark:text-gray-400 cus_showtext line-clamp-2"
                    >
                      {{ datadb_show.interestingInformation_detail }}
                    </p>
                    <div class="flex">
                      <svg
                        class="w-4 h-4 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                          clip-rule="evenodd"
                        />
                      </svg>

                      <p class="ml-2 c_textsdate">{{ datadb_show.created_at }}</p>
                    </div>
                  </div>
                </div>
              </Link>
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
  datadb: Object,
  title: Object,
});
</script>
