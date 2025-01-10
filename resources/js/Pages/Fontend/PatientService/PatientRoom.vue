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
              บริการห้องพักผู้ป่วย (ห้องพิเศษ)
            </h5>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
              โรงพยาบาลสตูล ได้จัดให้มีบริการห้องพักผู้ป่วย (ห้องพิเศษ)
              สำหรับผู้เข้ารับบริการ โดยมีรายละเอียด ดังนี้
            </p>
            <!-- --- ขั้นตอนการจองห้อง ----- -->
            <p class="mt-4 font-bold">ขั้นตอนการจองห้อง</p>
            <ul class="pl-10 list-disc">
              <li
                v-for="(booking, index) in page_patient_rooms.room_booking_detail"
                :key="page_patient_rooms.room_booking_detail.index"
              >
                {{ booking["th"] }}
              </li>
            </ul>
            <!-- -------- -->
            <!-- --- สิ่งอำนวยความสะดวก ----- -->
            <p class="mt-4 font-bold">สิ่งอำนวยความสะดวก</p>
            <ul class="pl-10 list-disc">
              <li
                v-for="(booking, index) in page_patient_rooms.room_facilities_detail"
                :key="page_patient_rooms.room_facilities_detail.index"
              >
                {{ booking["th"] }}
              </li>
            </ul>
            <!-- -------- -->
          </div>
        </div>
      </section>
      <!-- ------ราคาห้องพิเศษ 2567------- -->
      <div class="fadeInUp-animation">
        <h5
          class="mt-8 mb-3 text-base font-semibold text-center text-gray-900 md:text-2xl dark:text-white"
        >
          ราคาห้องพิเศษ 2567
        </h5>
        <p class="text-sm font-normal text-center text-gray-500 dark:text-gray-400">
          ตั้งแต่วันที่ 15 มีนาคม 2567
        </p>
        <hr class="mt-3" />
        <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
          <div
            v-for="(booking, index) in page_patient_room_prices"
            :key="page_patient_room_prices.index"
            class="w-full mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
          >
            <a href="#">
              <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
              <div>
                <h5
                  class="p-3 mb-2 font-bold tracking-tight text-center text-gray-900 text-1xl dark:text-white"
                >
                  {{ booking["room_type_th"] }}
                </h5>
              </div>
              <div class="p-3 bg-slate-100">
                <h5 class="text-3xl font-bold text-center text-gray-500 dark:text-white">
                  {{ booking["room_price"] }}
                </h5>
                <p class="text-center text-gray-500">บาท</p>
              </div>
            </a>
            <div class="p-5">
              <div v-for="(address, indexa) in page_patient_room_prices[index].room_address_th"
              :key="page_patient_room_prices[index].room_address_th.indexa">
                <p class="mb-3 font-normal text-center text-gray-700 dark:text-gray-400">
                  {{ address }}
                </p>
                <hr />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ------------ -->
      <section class="section-3 mt-9 fadeInUp-animation">
        <div class="container mx-auto">
          <div
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700"
          >
            <!-- --- ขั้นตอนการจองห้อง ----- -->
            <p class="mt-4 font-bold">การบริการอาหาร</p>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
              โรงพยาบาลจะนำอาหารมาบริการตามช่วงเวลา ดังนี้
            </p>
            <ul class="pl-10 mt-2 list-disc">
              <li
                v-for="(booking, index) in page_patient_rooms.room_food_service_detail"
                :key="page_patient_rooms.room_food_service_detail.index"
              >
                {{ booking["th"] }}
              </li>
            </ul>
            <!-- -------- -->
            <!-- --- สิ่งอำนวยความสะดวก ----- -->
            <p class="mt-4 font-bold">ประกาศเพิ่มเติม</p>
            <ul class="pl-10 mt-2 list-disc">
              <li
                v-for="(
                  booking, index
                ) in page_patient_rooms.room_additional_announcements_detail"
                :key="page_patient_rooms.room_additional_announcements_detail.index"
              >
                {{ booking["th"] }}
              </li>
            </ul>
            <p class="mt-4 font-bold">ภาพห้องพิเศษ</p>
            <p>— อยู่ระหว่างการปรับปรุงภาพถ่าย —</p>
            <!-- -------- -->
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
  page_patient_rooms: Object,
  page_patient_room_prices: Object,
});

console.log(datadb.page_patient_rooms, datadb.page_patient_room_prices);
</script>
