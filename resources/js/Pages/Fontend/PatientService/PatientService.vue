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
              ดาวน์โหลดตารางแพทย์แยกตามคลินิก/ห้องตรวจ
            </h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
              ข้อมูลทั้งหมด
            </p>
            <ul
              class="my-4 space-y-3"
              v-for="(doctor_table, index) in doctor_tables.doctor_table_section"
            >
              <li>
                <div
                  class="items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white"
                >
                  <div class="flex items-center">
                    <!-- <svg
                      @click="ClickOpenYear(index)"
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
                    </svg> -->
                    <span class="flex-1 ms-3 whitespace-nowrap">{{
                      doctor_table.name_th
                    }}</span>
                  </div>
                  <!-- <div v-if="OpenYear.year[index] === 'y'"> -->
                  <div v-for="doctor_table_detail in doctor_table.doctor_table_details">
                    <a :href="doctor_table_detail.files" target="_blank">
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
                          >{{ doctor_table_detail.name_th }}</span
                        >
                      </div>
                    </a>
                  </div>
                  <!-- </div> -->
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
  doctor_tables: Object,
  titlenews: Object,
});

console.log(datadb.doctor_tables);

//   const OpenYear = useForm({
//     year: [],
//   });

//   for (let index = 0; index < datadb.itaSectiondb.length; index++) {
//     OpenYear.year[index] = "n";
//   }

//   const ClickOpenYear = (keyYear) => {
//     if (OpenYear.year[keyYear] == "y") {
//       OpenYear.year[keyYear] = "n";
//     } else {
//       OpenYear.year[keyYear] = "y";
//     }

//     for (let index = 0; index < datadb.itaSectiondb.length; index++) {
//       if (index != keyYear) {
//           OpenYear.year[index] = "n";
//       }
//     }
//   };
</script>
