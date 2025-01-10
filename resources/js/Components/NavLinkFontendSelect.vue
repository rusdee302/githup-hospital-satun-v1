<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
// import { useRoute } from 'vue-router';

const props = defineProps({
  href: {
    type: String,
    required: true,
  },
  active: {
    type: Boolean,
  },
  navname: {
    type: String,
  },
});

var act = window.location.href;
let position = act.search("PressRelease");
let positionPur = act.search("NewsPurchase");

let PatientNewsRelease1 = act.search("PressRelease/%E0%B8%82%E0%B9%88%E0%B8%B2%E0%B8%A7%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%8A%E0%B8%B2%E0%B8%AA%E0%B8%B1%E0%B8%A1%E0%B8%9E%E0%B8%B1%E0%B8%99%E0%B8%98%E0%B9%8C");
let PatientNewsRelease2 = act.search("NewsPurchase/%E0%B8%82%E0%B9%88%E0%B8%B2%E0%B8%A7%E0%B8%88%E0%B8%B1%E0%B8%94%E0%B8%8B%E0%B8%B7%E0%B9%89%E0%B8%AD%E0%B8%88%E0%B8%B1%E0%B8%94%E0%B8%88%E0%B9%89%E0%B8%B2%E0%B8%87");
let PatientNewsRelease3 = act.search("PressRelease/%E0%B8%82%E0%B9%88%E0%B8%B2%E0%B8%A7%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%AA%E0%B8%A1%E0%B8%B1%E0%B8%84%E0%B8%A3%E0%B8%87%E0%B8%B2%E0%B8%99");
let PatientNewsRelease4 = act.search("PressRelease/%E0%B8%82%E0%B9%88%E0%B8%B2%E0%B8%A7%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%88%E0%B8%B2%E0%B8%81");


let PatientServicePosition = act.search("PatientService");
let PatientServicePositionIndex = act.search("DoctorTable/index");
let PatientServicePatientRoomIndex = act.search("PatientRoom/index");

var stylrtrueTitle = 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out';
var stylrfaleTitle = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';

var stylrtrue = 'block px-4 py-2 text-blue-600  underline underline-offset-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white';
var stylrfale = 'block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white';

// ------------- ข่าวสาร/วารสาร
console.log(act);
const classes = computed(() =>
  position > -1 || positionPur > -1
    ? stylrtrueTitle
    : stylrfaleTitle
);

const classNewsPressRelease1 = computed(() =>
PatientNewsRelease1 > -1
    ? stylrtrue
    : stylrfale
);

const classNewsPressRelease2 = computed(() =>
PatientNewsRelease2 > -1
    ? stylrtrue
    : stylrfale
);

const classNewsPressRelease3 = computed(() =>
PatientNewsRelease3 > -1
    ? stylrtrue
    : stylrfale
);

const classNewsPressRelease4 = computed(() =>
PatientNewsRelease4 > -1
    ? stylrtrue
    : stylrfale
);

// ------------- บริการสำหรับผู้ป่วย
const classPatientService = computed(() =>
  PatientServicePosition > -1
  ? stylrtrueTitle
  : stylrfaleTitle
);

const classPatientServiceIndex = computed(() =>
  PatientServicePositionIndex > -1
    ? stylrtrue
    : stylrfale
);

const classPatientServicePatientRoomIndex = computed(() =>
PatientServicePatientRoomIndex > -1
    ? stylrtrue
    : stylrfale
);
</script>

<template>
  <li v-if="navname === 'news'">
    <button
      id="dropdownNavbarLink"
      data-dropdown-toggle="dropdownNavbar"
      :class="classes"
    >
      ข่าวสาร/วารสาร
      <svg
        class="w-2.5 h-2.5 ms-2.5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 10 6"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 4 4 4-4"
        />
      </svg>
    </button>
    <!-- Dropdown menu -->
    <div
      id="dropdownNavbar"
      class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
    >
      <ul
        class="py-2 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownLargeButton"
      >
        <li>
          <Link
            @click="tNav('News')"
            :href="route('News.Press_Release', 'ข่าวประชาสัมพันธ์')"
            :class="classNewsPressRelease1"
            >ข่าวประชาสัมพันธ์</Link
          >
        </li>
        <li>
          <Link
            :href="route('News.News_purchase', 'ข่าวจัดซื้อจัดจ้าง')"
            :class="classNewsPressRelease2"
            >ข่าวสารจัดซื้อ/จัดจ้าง</Link
          >
        </li>
        <li>
          <Link
            :href="route('News.Press_Release', 'ข่าวรับสมัครงาน')"
            :class="classNewsPressRelease3"
            >ข่าวรับสมัครงาน</Link
          >
        </li>
        <li>
          <Link
            :href="route('News.Press_Release', 'ข่าวบริจาก')"
            :class="classNewsPressRelease4"
            >ข่าวบริจาก</Link
          >
        </li>
      </ul>
    </div>
  </li>

  <li v-else-if="navname === 'PatientService'">
    <button
      id="dropdownNavbarLink_6"
      data-dropdown-toggle="dropdownNavbar_6"
      :class="classPatientService"
    >
      บริการสำหรับผู้ป่วย
      <svg
        class="w-2.5 h-2.5 ms-2.5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 10 6"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 4 4 4-4"
        />
      </svg>
    </button>
    <!-- Dropdown menu -->
    <div
      id="dropdownNavbar_6"
      class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600"
    >
      <ul
        class="py-2 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownLargeButton"
      >
        <li>
          <a
            :href="route('News.Press_Release', 'ข่าวประชาสัมพันธ์')"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >ศูนย์สุขภาพมะฮอกกานี (SMC)</a
          >
        </li>
        <li>
          <Link
            :href="route('PatientService.DoctorTable_index')"
            :class="classPatientServiceIndex"
            >ตารางแพทย์ออกตรวจ</Link
          >
        </li>
        <li>
          <Link
            :href="route('PatientService.PatientRoom_index')"
            :class="classPatientServicePatientRoomIndex"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >ห้องพักผู้ป่วย (ห้องพิเศษ)</Link
          >
        </li>
        <li>
          <a
            href="#"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >Mahogany Medical Spa</a
          >
        </li>
        <li>
          <Link
            :href="route('PatientService.TreatmentForm_index')"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            >แบบฟอร์มขอประวัติการรักษา</Link
          >
        </li>
      </ul>
    </div>
  </li>
</template>
