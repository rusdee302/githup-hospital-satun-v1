<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const formSection = useForm({
    room_booking_detail_th_add: "",
    room_booking_detail_en_add: "",
    id_manage: "",
    db_coulunm: "room_food_service_detail",
});

const submit = () => {
    console.log(formSection.room_booking_detail_th_add);
  if (formSection.room_booking_detail_th_add != "") {
    formSection.post(route("Manage.MPatientRoom_insert"), {});
    formSection.room_booking_detail_th_add = "";
    formSection.room_booking_detail_en_add = "";
  }
};
</script>
<template>
  <!-- ขั้นตอนการจองห้อง -->
  <div
    id="food-service-room-modal"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full p-4">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <form @submit.prevent="submit">
        <div
          class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
        >
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            เพิ่ม สิ่งอำนวยความสะดวก
          </h3>
          <button
            type="button"
            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="food-service-room-modal"
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
            >รายละเอียด (ภาษาไทย)</label
          >
          <textarea
            id="message"
            v-model="formSection.room_booking_detail_th_add"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="รายละเอียด (ภาษาไทย)"
          ></textarea>
          <label
            for="message"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >รายละเอียด (อังกฤษ)</label
          >
          <textarea
            id="message"
            v-model="formSection.room_booking_detail_en_add"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="รายละเอียด (อังกฤษ)"
          ></textarea>
        </div>
        <!-- Modal footer -->
        <div
          class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
        >
        <PrimaryButton  data-modal-hide="food-service-room-modal" class="w-50"> + เพิ่ม </PrimaryButton>
          <button
            data-modal-hide="food-service-room-modal"
            type="button"
            class="inline-flex items-center px-4 py-2 font-medium text-gray-900 bg-white border border-gray-200 rounded-lg w-50 ms-3 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
          >
            ยกเลิก
          </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</template>
