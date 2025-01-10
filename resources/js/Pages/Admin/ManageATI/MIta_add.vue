<template>
  <AdminLayout>
    <div>
      <div>
        <div
          class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
        >
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            สร้าง ITA
          </h5>
          <p class="font-normal text-gray-700 dark:text-gray-400">
            การประเมินคุณธรรมและความโปร่งใสในการดำเนินงานของหน่วยงานภาครัฐ
          </p>
        </div>
      </div>
      <div class="mt-5">
        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
          <form novalidate @submit.prevent="submit_ita">
            <div class="grid grid-flow-row-dense grid-cols-4 grid-rows-1">
              <div>
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >ITA ปี :</label
                >
                <select
                  v-model="formSubSection.year"
                  id="countries"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option>2560</option>
                  <option>2561</option>
                  <option>2562</option>
                  <option>2563</option>
                  <option>2564</option>
                  <option>2565</option>
                  <option>2566</option>
                  <option>2567</option>
                </select>
              </div>
              <div class="col-span-3 ml-3">
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >ITA หัวข้อ :</label
                >
                <input
                  v-model="formSubSection.name_select"
                  aria-label="disabled input"
                  data-modal-target="default-modal"
                  data-modal-toggle="default-modal"
                  type="text"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
              </div>
            </div>
            <div class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 mt-4">
              <div>
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >ITA หัวข้อย้อย :</label
                >
                <input
                  v-model="formSubSection.name"
                  type="text"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
              </div>
              <div class="ml-3">
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >ITA ไฟล์ (PDF) :</label
                >
                <input
                  @input="formSubSection.files = $event.target.files[0]"
                  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  id="file_input"
                  type="file"
                />
              </div>
            </div>
            <div class="grid grid-flow-row-dense grid-cols-2 grid-rows-1 mt-4">
              <div>
                <label
                  for="countries"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >ITA รายละเอียดเพิ่มเติม (ถ้ามี) :</label
                >
                <textarea
                  v-model="formSubSection.detail"
                  id="message"
                  rows="4"
                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Write your thoughts here..."
                ></textarea>
              </div>
            </div>
            <hr class="mt-4" />
            <PrimaryButton class="mt-3 w-50"> + เพิ่ม </PrimaryButton>
            <button
              @click="clear()"
              type="button"
              class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ms-3 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            >
              ยกเลิก
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Main modal -->
    <div
      id="default-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative w-full max-w-6xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              เลือกหัวข้อ ITA :
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
            <div class="flex">
              <p class="mt-1">กรณีหัวข้อใหม่กดปุ่มนี้</p>
              <button
                @click="tsshow.tsadd = 'y'"
                type="button"
                class="px-3 py-2 ml-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                + เพิ่มหัวข้อใหม่
              </button>
            </div>
            <!-- create new -->
            <form novalidate @submit.prevent="submit">
              <div v-if="tsshow.tsadd === 'y'">
                <div
                  class="relative p-3 overflow-x-auto bg-orange-100 shadow-md sm:rounded-lg"
                >
                  <div class="grid grid-flow-row-dense grid-cols-4">
                    <div>
                      <label
                        for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >ITA ปี :</label
                      >
                      <select
                        v-model="formSection.year"
                        id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      >
                        <option>2560</option>
                        <option>2561</option>
                        <option>2562</option>
                        <option>2563</option>
                        <option>2564</option>
                        <option>2565</option>
                        <option>2566</option>
                        <option>2567</option>
                      </select>
                    </div>
                    <div class="col-span-3 ml-3">
                      <label
                        for="countries"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >ITA หัวข้อใหม่ :</label
                      >
                      <input
                        v-model="formSection.name"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      />
                    </div>
                  </div>
                  <PrimaryButton class="mt-3 w-50"> + เพิ่ม </PrimaryButton>
                  <button
                    @click="tsshow.tsadd = 'n'"
                    type="button"
                    class="px-3 py-2 text-xs font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ms-3 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                  >
                    ยกเลิก
                  </button>
                </div>
              </div>
            </form>
            <!-- /create new -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table
                class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400"
              >
                <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                  <tr>
                    <th scope="col" class="p-4">
                      <div class="flex items-center">
                        <label for="checkbox-all">#</label>
                      </div>
                    </th>
                    <th scope="col" class="px-6 py-3">หัวข้อ ITA</th>
                    <th scope="col" class="px-6 py-3">ปี</th>
                    <th scope="col" class="px-6 py-3">สร้างเมื่อ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(ita_section, index) in ita_sections"
                    :key="ita_section.id"
                    class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600"
                  >
                    <td class="w-4 p-4">
                      <div class="flex items-center">
                        <input
                          id="default-radio-1"
                          type="radio"
                          v-model="formSubSection.key"
                          :value="index"
                          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        />
                        <label for="checkbox-table-3" class="sr-only">checkbox</label>
                      </div>
                    </td>
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      {{ ita_section.name }}
                    </th>
                    <td class="px-6 py-4">{{ ita_section.year }}</td>
                    <td class="px-6 py-4">{{ ita_section.at_create }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
          >
            <button
              @click="selectSe()"
              data-modal-hide="default-modal"
              type="button"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              เลือก
            </button>
            <button
              data-modal-hide="default-modal"
              type="button"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            >
              ยกเลิก
            </button>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  ita_sections: Object,
});

// console.log(props.ita_sections);
const tsshow = useForm({
  tsadd: "n",
});

const formSection = useForm({
  name: "",
  year: "",
  id_manage: "1",
});

const formSubSection = useForm({
  id_section: "",
  name: "",
  detail: "",
  year: "",
  id_manage: "1",
  key: "",
  name_select: "",
  files: null,
});

const selectSe = () => {
  formSubSection.name_select = props.ita_sections[formSubSection.key].name;
  // formSubSection.name = props.ita_sections[formSubSection.key].name;
  formSubSection.id_section = props.ita_sections[formSubSection.key].id;
};

const submit = () => {
  console.log(formSection.name, formSection.year);
  if (formSection.name != "") {
    formSection.post(route("Manage.MIta_create_insert"), {});
    formSection.name = "";
    formSection.year = "";

    tsshow.tsadd = "n";
  }
};

const submit_ita = () => {
  if (
    formSubSection.id_section != "" &&
    formSubSection.name != "" &&
    formSubSection.year != "" &&
    formSubSection.files != null
  ) {
    formSubSection.post(route("Manage.MIta_sub_create_insert"), {});

    swal({
      title: "สำเร็จ",
      text: "บันทึกสำเร็จ",
      icon: "success",
    }).then(function (value) {
      // console.log("returned value:", value);
      if (value) {
      }
    });
  } else {
    swal({
      title: "ข้อผิดผลาด?",
      text: "กรุณาตรวจสอบข้อมูล",
      icon: "info",
    }).then(function (value) {
      if (value) {
      }
    });
  }
  //   console.log(formSubSection.name, formSubSection.year, formSubSection.detail, formSubSection.id_section,formSubSection.files);
};

const clear = () => {
  formSubSection.id_section = "";
  formSubSection.name = "";
  formSubSection.detail = "";
  formSubSection.year = "";
  formSubSection.id_manage = "1";
  formSubSection.key = "";
  formSubSection.name_select = "";
};
</script>
