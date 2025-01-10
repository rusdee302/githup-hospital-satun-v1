<template>
  <FontLayout>
    <img
      src="https://www.yash.com/wp-content/uploads/2022/06/hc-new-blogs.jpg"
      alt=""
      class="w-full"
    />
    <div class="container mx-auto">
      <section class="section-3 mt-9">
        <div class="container mx-auto">
          <div
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700"
          >
            <h5
              class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white fadeInUp-animation"
            >
              ITA
            </h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400 fadeInUp-animation">
              การประเมินคุณธรรมและความโปร่งใสในการดำเนินงานของหน่วยงานภาครัฐ
            </p>
            <ul class="my-4 space-y-3" v-for="(itaSection, index) in itaSectiondb">
              <li >
                <div
                  class="items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white fadeInUp-animation"
                >
                  <div class="flex items-center">
                    <svg @click="ClickOpenYear(index)"
                      class="text-blue-700 w-7 h-7 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap"
                      >ITA {{ itaSection.year }}</span
                    >
                  </div>
                  <div v-if="OpenYear.year[index] === 'y'">
                    <div v-for="ita_section in itaSection.ita_section">
                      <div class="flex mt-2 ml-10">
                        <svg
                          class="w-5 h-5 text-teal-700 dark:text-white"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          width="24"
                          height="24"
                          fill="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            d="M4 6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11.613a2 2 0 0 0 1.346-.52l4.4-4a2 2 0 0 0 0-2.96l-4.4-4A2 2 0 0 0 15.613 6H4Z"
                          />
                        </svg>
                        <span
                          class="ml-2 text-sm font-normal text-gray-700 dark:text-gray-400"
                          >{{ ita_section.name }}</span
                        >
                      </div>
                      <div v-for="ita_sub_section in ita_section.ita_sub_section">
                        <a :href="ita_sub_section.files" target="_blank">
                          <div class="flex mt-2 ml-20">
                            <svg
                              class="w-5 h-5 text-teal-700 dark:text-whit"
                              aria-hidden="true"
                              xmlns="http://www.w3.org/2000/svg"
                              width="24"
                              height="24"
                              fill="currentColor"
                              viewBox="0 0 24 24"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd"
                              />
                            </svg>

                            <span
                              class="ml-2 text-sm font-normal text-gray-700 dark:text-gray-400"
                              >{{ ita_sub_section.name }}</span
                            >
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  </FontLayout>
</template>

<script setup>
import FontLayout from "@/Layouts/FontLayout.vue";

import { Link, useForm } from "@inertiajs/vue3";

const datadb = defineProps({
  itaSectiondb: Object,
  titlenews: Object,
});

const OpenYear = useForm({
  year: [],
});

for (let index = 0; index < datadb.itaSectiondb.length; index++) {
  OpenYear.year[index] = "n";
}

const ClickOpenYear = (keyYear) => {
  if (OpenYear.year[keyYear] == "y") {
    OpenYear.year[keyYear] = "n";
  } else {
    OpenYear.year[keyYear] = "y";
  }

  for (let index = 0; index < datadb.itaSectiondb.length; index++) {
    if (index != keyYear) {
        OpenYear.year[index] = "n";
    }
  }
};
</script>
