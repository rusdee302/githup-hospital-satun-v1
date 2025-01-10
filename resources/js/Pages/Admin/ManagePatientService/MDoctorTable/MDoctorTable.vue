<template>
  <AdminLayout>
    <div class="grid grid-cols-1 gap-4 mb-4">
      <div>
        <div
          class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        >
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            บริการสำหรับผู้ป่วย
          </h5>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            จัดการข้อมูลบริการสำหรับผู้ป่วย
          </p>
        </div>
      </div>
      <MPatientServiceMenu></MPatientServiceMenu>
      <div>
        <div class="mb-4 rounded bg-gray-50 dark:bg-gray-800">
          <div class="relative p-3 overflow-x-auto shadow-md sm:rounded-lg">
            <div
              class="flex flex-wrap items-center justify-between p-3 pb-4 space-y-4 bg-white flex-column md:flex-row md:space-y-0 dark:bg-gray-900"
            >
              <div class="flex">
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
                  <th scope="col" class="px-6 py-3 ">หัวข้อ (ไทย) </th>
                  <th scope="col" class="px-6 py-3 ">หัวข้อ (อังกฤษ)</th>
                  <th scope="col" class="px-6 py-3">จำนวน หัวข้อย่อย</th>
                  <th scope="col" class="px-6 py-3">วันที่สร้าง</th>
                  <th scope="col" class="px-6 py-3">ตั้งค่า</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(doctor_table, index) in doctor_tables.data"
                  :key="doctor_table.id"
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                >
                  <td class="w-4 p-4">
                    <div class="flex items-center">
                      <p>{{ index + doctor_tables.from }}</p>
                    </div>
                  </td>
                  <th
                    scope="row"
                    class="px-6 py-4 font-medium text-gray-900 w-80 whitespace-nowrap dark:text-white"
                  >
                    <div class="">
                      <p class="overflow-hidden text-ellipsis">{{ doctor_table.name_th }}</p>
                    </div>
                  </th>
                  <td class="px-6 py-4">{{ doctor_table.name_en }}</td>
                  <td class="px-6 py-4">{{ doctor_table.ita_sub_section_cont }}</td>
                  <td class="px-6 py-4">{{ doctor_table.create_date }}</td>
                  <td class="px-6 py-4">
                    <Link
                      :href="route('Manage.MDoctorTable_detail', doctor_table.id)"
                      type="button"
                      class="inline-flex items-center px-3 py-1 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-600 dark:focus:ring-green-600"
                    >
                      <svg
                        class="w-4 h-4 text-white"
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
                          d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                      </svg>

                      <!-- Add -->
                    </Link>
                    <button
                      @click="
                        CopyToModal(doctor_table.id, doctor_table.name_th, doctor_table.name_en)
                      "
                      data-modal-target="default-modal"
                      data-modal-toggle="default-modal"
                      type="button"
                      class="inline-flex items-center px-3 py-1 ml-2 text-xs font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-600 dark:focus:ring-green-600"
                    >
                      <svg
                        class="w-4 h-4 text-white"
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

                      <!-- Edit -->
                    </button>
                    <button
                      @click="
                        deleteSection(doctor_table.id, doctor_table.ita_sub_section_cont)
                      "
                      type="button"
                      class="inline-flex items-center px-3 py-1 ml-2 text-xs font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    >
                      <svg
                        class="w-4 h-4 text-white"
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
                      <!-- Delete -->
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <Pagination
              :links="doctor_tables.links"
              :datastart="doctor_tables.from"
              :datacount="doctor_tables.data.length"
              :datatotal="doctor_tables.total"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- ---------- add ------------- -->

    <div data-dial-init class="fixed bottom-6 end-6 group">
      <Link
        :href="route('Manage.MDoctorTable_create')"
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

    <!-- Main modal -->
    <div
      id="default-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative w-full max-w-2xl max-h-full p-4">
        <!-- Modal content -->
        <form novalidate @submit.prevent="submit">
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
            >
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                แก้ไขหัวข้อหลัก ITA
              </h3>
              <button
                type="button"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="default-modal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4 md:p-5">
              <label
                for="message"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >หัวข้อ (ไทย)</label
              >
              <textarea
                v-model="formSection.name_th"
                id="message"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your thoughts here..."
              ></textarea>
              <label
                for="message"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >หัวข้อ (อังกฤษ)</label
              >
              <textarea
                v-model="formSection.name_en"
                id="message"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your thoughts here..."
              ></textarea>
            </div>
            <!-- Modal footer -->
            <div
              class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
            >
              <PrimaryButton data-modal-hide="default-modal" class="">
                + เพิ่ม
              </PrimaryButton>
              <button
                data-modal-hide="default-modal"
                type="button"
                class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ms-3 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
              >
                ยกเลิก
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import MPatientServiceMenu from "@/Pages/Admin/ManagePatientService/Components/Menu.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
    doctor_tables: Object,
  NewsType: Object,
});

const formSection = useForm({
  id: "",
  name_th: "",
  name_en: "",
  id_manage: "1",
});

const dataDelete = useForm({
  id: "",
});

const CopyToModal = (id, name_th, name_en) => {
  formSection.id = id;
  formSection.name_th = name_th;
  formSection.name_en = name_en;
  formSection.id_manage = "1";
};

const submit = () => {
  console.log(formSection.name_th, formSection.name_en);
  //   if (formSection.name != "") {
  formSection.post(route("Manage.MDoctorTable_edit"), {});

  formSection.id = "";
  formSection.name_th = "";
  formSection.name_en = "";
  //   }
  swal({
    title: "สำเร็จ",
    text: "แก้ไขสำเร็จ",
    icon: "success",
  }).then(function (value) {
    // console.log("returned value:", value);
    if (value) {
    }
  });
};

const deleteSection = (id, ita_count) => {
  dataDelete.id = id;
  if (ita_count == 0) {
    dataDelete.post(route("Manage.MDoctorTable_delete"), {});

    swal({
      title: "สำเร็จ",
      text: "ลบสำเร็จ",
      icon: "success",
    }).then(function (value) {
      if (value) {
      }
    });
  } else {
    swal({
      title: "ข้อผิดผลาด?",
      text: "มีข้อมูลจำนวน " + ita_count + " ข้อมูล กรุณาลบข้อมูลดังกล่าวออกก่อน",
      icon: "info",
    }).then(function (value) {
      if (value) {
      }
    });
  }
};

// console.log(props.Newsdb);
</script>
