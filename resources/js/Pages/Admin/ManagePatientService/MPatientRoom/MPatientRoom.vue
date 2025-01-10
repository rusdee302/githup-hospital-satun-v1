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
            <!-- -------------------------- tabale --------------------- -->
            <div class="container mx-auto">
              <section class="section-3 mt-9">
                <div class="container mx-auto">
                  <div
                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700"
                  >
                    <h5
                      class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white"
                    >
                      บริการห้องพักผู้ป่วย (ห้องพิเศษ) {{ dbtype }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                      โรงพยาบาลสตูล ได้จัดให้มีบริการห้องพักผู้ป่วย (ห้องพิเศษ)
                      สำหรับผู้เข้ารับบริการ โดยมีรายละเอียด ดังนี้
                    </p>
                    <!-- --- ขั้นตอนการจองห้อง ----- -->
                    <p class="mt-4 font-bold">ขั้นตอนการจองห้อง</p>
                    <ul class="pl-10 list-disc">
                      <li
                        v-for="(room_booking_detail, index) in room_booking_details"
                        :key="room_booking_detail.index"
                      >
                        <div class="flex">
                          {{ room_booking_detail.th }}
                          <svg
                            @click="
                              ClickEditRoomBookingDetails(index, 'room_booking_detail')
                            "
                            data-modal-target="Booking-room-modal-edit"
                            data-modal-toggle="Booking-room-modal-edit"
                            class="w-6 h-6 ml-3 text-gray-800 dark:text-white"
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
                          <svg
                            @click="
                              ClickDeleteRoomBookingDetails(index, 'room_booking_detail')
                            "
                            class="w-6 h-6 ml-2 text-red-800 dark:text-white"
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
                              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                            />
                          </svg>
                        </div>
                      </li>
                    </ul>
                    <button
                      data-modal-target="Booking-room-modal"
                      data-modal-toggle="Booking-room-modal"
                      type="button"
                      class="flex px-3 py-1 ml-10 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                      <svg
                        class="w-4 h-4 mr-1 text-white-800 dark:text-white"
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

                      เพิ่ม
                    </button>
                    <!-- -------- -->
                    <!-- --- สิ่งอำนวยความสะดวก ----- -->
                    <p class="mt-4 font-bold">สิ่งอำนวยความสะดวก</p>
                    <ul class="pl-10 list-disc">
                      <li
                        v-for="(room_facilities_detail, index) in room_facilities_details"
                        :key="room_facilities_detail.index"
                      >
                        <div class="flex">
                          {{ room_facilities_detail.th }}
                          <svg
                            @click="
                              ClickEditRoomBookingDetails(index, 'room_facilities_detail')
                            "
                            data-modal-target="Booking-room-modal-edit"
                            data-modal-toggle="Booking-room-modal-edit"
                            class="w-6 h-6 ml-3 text-gray-800 dark:text-white"
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
                          <svg
                            @click="
                              ClickDeleteRoomBookingDetails(
                                index,
                                'room_facilities_detail'
                              )
                            "
                            class="w-6 h-6 ml-2 text-red-800 dark:text-white"
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
                              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                            />
                          </svg>
                        </div>
                      </li>
                    </ul>
                    <button
                      data-modal-target="Facilities-Booking-room-modal"
                      data-modal-toggle="Facilities-Booking-room-modal"
                      type="button"
                      class="flex px-3 py-1 ml-10 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                      <svg
                        class="w-4 h-4 mr-1 text-white-800 dark:text-white"
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

                      เพิ่ม
                    </button>
                    <!-- -------- -->
                  </div>
                </div>
              </section>
              <!-- ------ราคาห้องพิเศษ 2567------- -->
              <add_special_room_price :data_room="props.page_patient_room_prices"></add_special_room_price>
              <!-- ------------ -->
              <section class="section-3 mt-9">
                <div class="container mx-auto">
                  <div
                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700"
                  >
                    <!-- --- ขั้นตอนการจองห้อง ----- -->
                    <p class="mt-4 font-bold">การบริการอาหาร</p>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                      โรงพยาบาลจะนำอาหารมาบริการตามช่วงเวลา ดังนี้
                    </p>
                    <ul class="pl-10 list-disc">
                      <li
                        v-for="(room_food_service_detail, index) in room_food_service_details"
                        :key="room_food_service_details.index"
                      >
                        <div class="flex">
                          {{ room_food_service_detail.th }}
                          <svg
                            @click="
                              ClickEditRoomBookingDetails(index, 'room_food_service_detail')
                            "
                            data-modal-target="Booking-room-modal-edit"
                            data-modal-toggle="Booking-room-modal-edit"
                            class="w-6 h-6 ml-3 text-gray-800 dark:text-white"
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
                          <svg
                            @click="
                              ClickDeleteRoomBookingDetails(
                                index,
                                'room_food_service_detail'
                              )
                            "
                            class="w-6 h-6 ml-2 text-red-800 dark:text-white"
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
                              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                            />
                          </svg>
                        </div>
                      </li>
                    </ul>
                    <button
                      data-modal-target="food-service-room-modal"
                      data-modal-toggle="food-service-room-modal"
                      type="button"
                      class="flex px-3 py-1 ml-10 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                      <svg
                        class="w-4 h-4 mr-1 text-white-800 dark:text-white"
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

                      เพิ่ม
                    </button>
                    <!-- -------- -->
                    <!-- --- สิ่งอำนวยความสะดวก ----- -->
                    <p class="mt-4 font-bold">ประกาศเพิ่มเติม</p>
                    <ul class="pl-10 list-disc">
                        <li
                          v-for="(room_additional_annnouncements_detail, index) in room_additional_annnouncements_details"
                          :key="room_additional_annnouncements_details.index"
                        >
                          <div class="flex">
                            {{ room_additional_annnouncements_detail.th }}
                            <svg
                              @click="
                                ClickEditRoomBookingDetails(index, 'room_additional_announcements_detail')
                              "
                              data-modal-target="Booking-room-modal-edit"
                              data-modal-toggle="Booking-room-modal-edit"
                              class="w-6 h-6 ml-3 text-gray-800 dark:text-white"
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
                            <svg
                              @click="
                                ClickDeleteRoomBookingDetails(
                                  index,
                                  'room_additional_announcements_detail'
                                )
                              "
                              class="w-6 h-6 ml-2 text-red-800 dark:text-white"
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
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"
                              />
                            </svg>
                          </div>
                        </li>
                      </ul>
                      <button
                        data-modal-target="additional-announcements-room-modal"
                        data-modal-toggle="additional-announcements-room-modal"
                        type="button"
                        class="flex px-3 py-1 ml-10 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                      >
                        <svg
                          class="w-4 h-4 mr-1 text-white-800 dark:text-white"
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

                        เพิ่ม
                      </button>
                    <p class="mt-4 font-bold">ภาพห้องพิเศษ</p>
                    <p>— อยู่ระหว่างการปรับปรุงภาพถ่าย — {{ dbtype }}</p>
                    <!-- -------- -->
                  </div>
                </div>
              </section>
            </div>
            <!-- -------------------------- /tabale --------------------- -->
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------- moadal ------------------------ -->
    <modal_add_ProcedureBookingRoom></modal_add_ProcedureBookingRoom>
    <modal_add_FacilitiesBookingRoom></modal_add_FacilitiesBookingRoom>
    <modal_add_FoodServiceRoom></modal_add_FoodServiceRoom>
    <modal_add_AdditionalAnnouncementsRoom></modal_add_AdditionalAnnouncementsRoom>


    <!-- ขั้นตอนการจองห้อง -->
    <div
      id="Booking-room-modal-edit"
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
                เพิ่ม ขั้นตอนการจองห้อง
              </h3>
              <button
                type="button"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="Booking-room-modal-edit"
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
                v-model="FormEditRoomBookingDetails.room_booking_detail_th_edit"
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
                v-model="FormEditRoomBookingDetails.room_booking_detail_en_edit"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="รายละเอียด (อังกฤษ)"
              ></textarea>
            </div>
            <!-- Modal footer -->
            <div
              class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
            >
              <PrimaryButton data-modal-hide="Booking-room-modal-edit" class="w-50">
                + ยืนยัน
              </PrimaryButton>
              <button
                data-modal-hide="Booking-room-modal-edit"
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
    <!-- -------------------- /moadal ------------------------ -->
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MPatientServiceMenu from "@/Pages/Admin/ManagePatientService/Components/Menu.vue";
import modal_add_ProcedureBookingRoom from "@/Pages/Admin/ManagePatientService/MPatientRoom/Components/modal_add_ProcedureBookingRoom.vue";
import modal_add_FacilitiesBookingRoom from "@/Pages/Admin/ManagePatientService/MPatientRoom/Components/modal_add_FacilitiesBookingRoom.vue";
import modal_add_FoodServiceRoom from "@/Pages/Admin/ManagePatientService/MPatientRoom/Components/modal_add_FoodServiceRoom.vue";
import modal_add_AdditionalAnnouncementsRoom from "@/Pages/Admin/ManagePatientService/MPatientRoom/Components/modal_add_AdditionalAnnouncementsRoom.vue";
import add_special_room_price from "@/Pages/Admin/ManagePatientService/MPatientRoom/Components/add_special_room_price.vue";

const showingNavigationDropdown = ref(false);

const props = defineProps({
  room_booking_details: Object,
  room_facilities_details: Object,
  room_food_service_details: Object,
  room_additional_annnouncements_details: Object,
  page_patient_room_prices: Object,
});

const FormEditRoomBookingDetails = useForm({
  room_booking_detail_th_edit: "",
  room_booking_detail_en_edit: "",
  id_manage: "",
  arr: "",
  db_coulunm: "",
});
const ClickEditRoomBookingDetails = (arr, db) => {
  if (db == "room_booking_detail") {
    FormEditRoomBookingDetails.room_booking_detail_th_edit =
      props.room_booking_details[arr].th;
    FormEditRoomBookingDetails.room_booking_detail_en_edit =
      props.room_booking_details[arr].en;
    FormEditRoomBookingDetails.id_manage = props.room_booking_details[arr].id_manage;
    FormEditRoomBookingDetails.arr = arr;
    FormEditRoomBookingDetails.db_coulunm = db;
  } else if (db == "room_facilities_detail") {
    FormEditRoomBookingDetails.room_booking_detail_th_edit =
      props.room_facilities_details[arr].th;
    FormEditRoomBookingDetails.room_booking_detail_en_edit =
      props.room_facilities_details[arr].en;
    FormEditRoomBookingDetails.id_manage = props.room_facilities_details[arr].id_manage;
    FormEditRoomBookingDetails.arr = arr;
    FormEditRoomBookingDetails.db_coulunm = db;
  } else if (db == "room_food_service_detail") {
    FormEditRoomBookingDetails.room_booking_detail_th_edit =
      props.room_food_service_details[arr].th;
    FormEditRoomBookingDetails.room_booking_detail_en_edit =
      props.room_food_service_details[arr].en;
    FormEditRoomBookingDetails.id_manage = props.room_food_service_details[arr].id_manage;
    FormEditRoomBookingDetails.arr = arr;
    FormEditRoomBookingDetails.db_coulunm = db;
  } else if (db == "room_additional_announcements_detail") {
    FormEditRoomBookingDetails.room_booking_detail_th_edit =
      props.room_additional_annnouncements_details[arr].th;
    FormEditRoomBookingDetails.room_booking_detail_en_edit =
      props.room_additional_annnouncements_details[arr].en;
    FormEditRoomBookingDetails.id_manage = props.room_additional_annnouncements_details[arr].id_manage;
    FormEditRoomBookingDetails.arr = arr;
    FormEditRoomBookingDetails.db_coulunm = db;
  }
};

const ClickDeleteRoomBookingDetails = (arr, db) => {
  FormEditRoomBookingDetails.arr = arr;
  FormEditRoomBookingDetails.db_coulunm = db;
  if (db == "room_booking_detail") {
    if (confirm("คุนต้องการลบข้อมูล : " + props.room_booking_details[arr].th + " ?")) {
      FormEditRoomBookingDetails.post(route("Manage.MPatientRoom_delete"), {});
    } else {
    }
  } else if (db == "room_facilities_detail") {
    if (confirm("คุนต้องการลบข้อมูล : " + props.room_facilities_details[arr].th + " ?")) {
      FormEditRoomBookingDetails.post(route("Manage.MPatientRoom_delete"), {});
    } else {
    }
  } else if (db == "room_food_service_detail") {
    if (confirm("คุนต้องการลบข้อมูล : " + props.room_food_service_details[arr].th + " ?")) {
      FormEditRoomBookingDetails.post(route("Manage.MPatientRoom_delete"), {});
    } else {
    }
  } else if (db == "room_additional_announcements_detail") {
    if (confirm("คุนต้องการลบข้อมูล : " + props.room_additional_annnouncements_details[arr].th + " ?")) {
      FormEditRoomBookingDetails.post(route("Manage.MPatientRoom_delete"), {});
    } else {
    }
  }
};

const submit = () => {
  if (FormEditRoomBookingDetails.room_booking_detail_th_edit != "") {
    FormEditRoomBookingDetails.post(route("Manage.MPatientRoom_edit"), {});
    FormEditRoomBookingDetails.room_booking_detail_th_edit = "";
    FormEditRoomBookingDetails.room_booking_detail_en_edit = "";
    FormEditRoomBookingDetails.id_manage = "";
    FormEditRoomBookingDetails.arr = "";
  }
};
// console.log(props.room_booking_details[0]);
</script>
