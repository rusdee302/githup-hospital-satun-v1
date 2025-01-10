<script setup>
import { ref, computed, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
// import MNews_Anyway from "./Component/MNews_Anyway.vue";
const showingNavigationDropdown = ref(false);

let search = ref(""),
  pageNumber = ref(1);

let NewsUel = computed(() => {
  let url = new URL(route("Manage.MNews"));
  url.searchParams.append("page", pageNumber.value);

  if (search.value) {
    url.searchParams.append("search", search.value);
  }

  return url;
});

watch(
  () => NewsUel.value,
  (updatedNewsUel) => {
    router.visit(updatedNewsUel, {
      preserveScroll: true,

      preserveState: true,

      replace: true,
    });
  }
);

const props = defineProps({
  Interestinginformationdb: Object,
  InterestinginformationType: Object,
});

// console.log(props.Interestinginformationdb);
</script>

<template>
  <AdminLayout>
    <div class="grid grid-cols-1 gap-4 mb-4">
      <div>
        <a
          href="#"
          class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        >
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            เพิ่มข้อมูลที่น่าสนใจ
          </h5>
          <p class="font-normal text-gray-700 dark:text-gray-400">ข้อมูลที่น่าสนใจ</p>
        </a>
      </div>
    </div>
    <div class="mb-4 rounded bg-gray-50 dark:bg-gray-800">
      <div class="relative p-3 overflow-x-auto shadow-md sm:rounded-lg">
        <div
          class="flex flex-wrap items-center justify-between p-3 pb-4 space-y-4 bg-white flex-column md:flex-row md:space-y-0 dark:bg-gray-900"
        >
          <div class="flex">
            <!-- <input
              type="date"
              id="table-search-users"
              class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Search for users"
            />
            <p class="mt-2 ml-2 mr-2">ถึง</p>
            <input
              type="date"
              id="table-search-users"
              class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Search for users"
            /> -->
          </div>
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative">
            <div
              class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3"
            >
              <svg
                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
            </div>
            <input
              v-model="search"
              type="text"
              id="table-search-users"
              class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Search for users"
            />
          </div>
        </div>
        <table
          class="w-full text-sm text-left text-gray-500 table-fixed rtl:text-right dark:text-gray-400"
        >
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="w-4 p-4">
                <div class="flex items-center">
                  <p>#</p>
                </div>
              </th>
              <th scope="col" class="w-2/5 px-6 py-3">หัวข้อข่าว</th>
              <th scope="col" class="w-1/6 px-6 py-3">ประเภทข่าว</th>
              <th scope="col" class="w-1/6 px-6 py-3">วันที่สร้าง</th>
              <th scope="col" class="px-6 py-3">ตั้งค่า</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(
                InterestinginformationType_s, index
              ) in Interestinginformationdb.data"
              :key="InterestinginformationType_s.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
            >
              <td class="w-4 p-4">
                <div class="flex items-center">
                  <p>{{ index + Interestinginformationdb.from }}</p>
                </div>
              </td>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 w-80 whitespace-nowrap dark:text-white"
              >
                <div class="">
                  <p class="overflow-hidden text-ellipsis">
                    {{ InterestinginformationType_s.interestingInformation_title }}
                  </p>
                </div>
              </th>
              <td class="px-6 py-4">
                {{ InterestinginformationType_s.interestingInformation_type }}
              </td>
              <td class="px-6 py-4">{{ InterestinginformationType_s.created_at }}</td>
              <td class="px-6 py-4">
                <Link
                  :href="
                    route(
                      'Manage.MHealthSubstances_edit',
                      InterestinginformationType_s.id
                    )
                  "
                  type="button"
                  class="inline-flex items-center px-3 py-1 text-xs font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-600 dark:focus:ring-green-600"
                >
                  <svg
                    class="w-4 h-4 text-white me-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"
                    />
                  </svg>

                  Edit
                </Link>
                <Link
                  :href="
                    route(
                      'Manage.MHealthSubstances_move_bin',
                      InterestinginformationType_s.id
                    )
                  "
                  type="button"
                  class="inline-flex items-center px-3 py-1 ml-4 text-xs font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                >
                  <svg
                    class="w-4 h-4 text-white me-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  Delete
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
        <Pagination
          :links="Interestinginformationdb.links"
          :datastart="Interestinginformationdb.from"
          :datacount="Interestinginformationdb.data.length"
          :datatotal="Interestinginformationdb.total"
        />
      </div>
    </div>
    <!-- ---------- add ------------- -->

    <div data-dial-init class="fixed bottom-6 end-6 group">
      <Link
        :href="route('Manage.MHealthSubstances_create')"
        type="button"
        class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800"
      >
        <svg
          class="w-5 h-5 transition-transform group-hover:rotate-45"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 18 18"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 1v16M1 9h16"
          />
        </svg>
        <span class="sr-only">Open actions menu</span>
      </Link>
    </div>
  </AdminLayout>
</template>
