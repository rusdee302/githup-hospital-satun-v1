<script setup>
// import { ref } from "vue";
import { computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import FontLayout from "@/Layouts/FontLayout.vue";
import MenuNewsHome from "@/Components/MenuNewsHome.vue";

const props = defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },

  activeMenuNews: {
    type: Boolean,
  },

  banners: Object,
  NewsPressreleases: Object,
  NewsProcurement: Object,
  NewsJob: Object,
  NewsDonation: Object,
  potentialdb: Object,

  interestinginformation_1: Object,
  interestinginformation_2: Object,
  interestinginformation_3: Object,
});

const act = useForm({
  act_submenu_news: "NewsPressreleases",
  news_show: props.NewsPressreleases,
  btn_link: "News.Press_Release",
  btn_link_data: "ข่าวประชาสัมพันธ์",
});

const tNews = (t) => {
  if (t == "NewsPressreleases") {
    act.act_submenu_news = "NewsPressreleases";
    act.news_show = props.NewsPressreleases;
    act.btn_link = "News.Press_Release";
    act.btn_link_data = "ข่าวประชาสัมพันธ์";
  } else if (t == "NewsDonation") {
    act.act_submenu_news = "NewsDonation";
    act.news_show = props.NewsDonation;
    act.btn_link = "News.Press_Release";
    act.btn_link_data = "ข่าวบริจาก";
  } else if (t == "NewsProcurement") {
    act.act_submenu_news = "NewsProcurement";
    act.news_show = props.NewsProcurement;
    act.btn_link = "News.News_purchase";
    act.btn_link_data = "ข่าวจัดซื้อจัดจ้าง";
  } else if (t == "NewsJob") {
    act.act_submenu_news = "NewsJob";
    act.news_show = props.NewsJob;
    act.btn_link = "News.Press_Release";
    act.btn_link_data = "ข่าวรับสมัครงาน";
  }
};

const act_i = useForm({
  act_submenu_i: "interestinginformation_1",
  i_show: props.interestinginformation_1,
  btn_link: "InterestingInformation.InterestingInformation",
  btn_link_data: "สารสุขภาพ",
});

const tInterestinginformation = (t) => {
  if (t == "Interestinginformation_1") {
    act_i.act_submenu_i = "interestinginformation_1";
    act_i.i_show = props.interestinginformation_1;
    act_i.btn_link = "InterestingInformation.InterestingInformation";
    act_i.btn_link_data = "สารสุขภาพ";
  } else if (t == "Interestinginformation_2") {
    act_i.act_submenu_i = "interestinginformation_2";
    act_i.i_show = props.interestinginformation_2;
    act_i.btn_link = "InterestingInformation.InterestingInformation";
    act_i.btn_link_data = "ประกาศ-นโยบาย-มาตรฐานบริการ";
  } else if (t == "Interestinginformation_3") {
    act_i.act_submenu_i = "interestinginformation_3";
    act_i.i_show = props.interestinginformation_3;
    act_i.btn_link = "InterestingInformation.InterestingInformation";
    act_i.btn_link_data = "งบทดลองระบบ GFMIS";
  }
};

// console.log(act.news_show);
function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
  <FontLayout>
    <section class="mt-8 section-1">
      <div>
        <div id="default-carousel" class="sticky w-full" data-carousel="slide">
          <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <div
              v-for="(banner, index) in banners"
              class="hidden duration-700 ease-in-out"
              data-carousel-item
            >
              <img
                :src="banner.image"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="..."
              />
            </div>

            <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img
                src="https://www.shutterstock.com/image-photo/healthcare-people-group-professional-doctor-260nw-1213711042.jpg"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="..."
              />
            </div>

            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img
                src="https://www.shutterstock.com/image-photo/doctors-group-260nw-627134690.jpg"
                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                alt="..."
              />
            </div>
            <!-- Item 4 -->
            <!-- Item 5 -->
            -->
          </div>
          <!-- Slider indicators -->
          <div
            class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse"
          >
            <button
              v-for="(banner, index) in banners"
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="true"
              aria-label="Slide 1"
              :data-carousel-slide-to="index + 1"
            ></button>
          </div>
          <!-- Slider controls -->
          <button
            type="button"
            class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none"
            data-carousel-prev
          >
            <span
              class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
            >
              <svg
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 6 10"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 1 1 5l4 4"
                />
              </svg>
              <span class="sr-only">Previous</span>
            </span>
          </button>
          <button
            type="button"
            class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none"
            data-carousel-next
          >
            <span
              class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none"
            >
              <svg
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 6 10"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 9 4-4-4-4"
                />
              </svg>
              <span class="sr-only">Next</span>
            </span>
          </button>
        </div>
      </div>
    </section>

    <section class="section-2 fadeInUp-animation">
      <div class="container mx-auto">
        <div class="mt-5 text-center">
          <p
            class="text-2xl font-semibold leading-normal text-center text-gray-900 dark:text-white"
          >
            ยินดีต้อนรับสู่โรงพยาบาลสตูล
          </p>
          <div class="">
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
          </div>
          <p class="mt-6">
            โรงพยาบาลสตูล เป็นโรงพยาบาลศูนย์ประจำจังหวัดภูเก็ต ขนาด 551 เตียง
            ให้บริการทางการแพทย์ระดับตติยภูมิและเฉพาะทางขั้นสูง
            ครอบคลุมถึงระดับปฐมภูมิและทุติยภูมิ
          </p>
        </div>
        <div class="mt-4">
          <div class="grid grid-cols-1 gap-5 md:grid-cols-5">
            <div class="w-full h-100">
              <div class="w-full text-center h-100">
                <Link
                  :href="route('PatientService.DoctorTable_index')"
                  class="block max-w-sm p-6 border border-gray-200 rounded-lg shadow d-bg-color-1 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="text-white w-9 h-9 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-white text-1xl dark:text-white"
                  >
                    ตารางแพทออกตรวจ
                  </h5>
                </Link>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <Link
                  :href="route('PatientService.PatientRoom_index')"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow d-bg-color-2 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="text-white w-9 h-9 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-white text-1xl dark:text-white"
                  >
                    ห้องพิเศษ
                  </h5>
                </Link>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow d-bg-color-3 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="text-white w-9 h-9 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H4Zm0 6h16v6H4v-6Z"
                        clip-rule="evenodd"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M5 14a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1Zm5 0a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2h-5a1 1 0 0 1-1-1Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-white text-1xl dark:text-white"
                  >
                    ตรวจสอบสิทธิการรักษา
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow d-bg-color-4 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="text-white w-9 h-9 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-white text-1xl dark:text-white"
                  >
                    วารสารวิทยาศาสตร์สุขภาพฯ
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow d-bg-color-5 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="text-white w-9 h-9 dark:text-white"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-6.616l-2.88 2.592C8.537 20.461 7 19.776 7 18.477V17H5a2 2 0 0 1-2-2V6Zm4 2a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2H7Zm8 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2Zm-8 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H7Zm5 0a1 1 0 1 0 0 2h5a1 1 0 1 0 0-2h-5Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-white text-1xl dark:text-white"
                  >
                    คำถามที่พบบ่อย
                  </h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-3 mt-9 fadeInUp-animation">
      <div class="container mx-auto">
        <div class="mt-5 text-center">
          <p
            class="text-2xl font-semibold leading-normal text-center text-gray-900 dark:text-white"
          >
            ข่าวสารและกิจกรรมล่าสุด
          </p>
          <div class="">
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
          </div>
        </div>

        <div class="sm:hidden">
          <label for="tabs" class="sr-only">Select your country</label>
          <select
            v-model="act.act_submenu_news"
            @change="tNews(act.act_submenu_news)"
            id="tabs"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full .5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <!-- <MenuNewsHomeResponsive :act="'NewsPressreleases'" :link="act.act_submenu_news" @click="tNews('NewsPressreleases')">ข่าวประชาสัมพันธ์</MenuNewsHomeResponsive>
            <MenuNewsHomeResponsive :act="'NewsDonation'" :link="act.act_submenu_news" @click="tNews('NewsDonation')">ข่าวบริจาก</MenuNewsHomeResponsive> -->
            <option value="NewsPressreleases">ข่าวประชาสัมพันธ์</option>
            <option value="NewsDonation">ข่าวบริจาก</option>
            <option value="NewsProcurement">ข่าวจัดซื้อ/จัดจ้าง</option>
            <option value="NewsJob">ข่าวรับสมัคร</option>
            <option>งบทดลองระบบ GFMIS</option>
          </select>
        </div>
        <ul
          class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400"
        >
          <MenuNewsHome
            :act="'NewsPressreleases'"
            :link="act.act_submenu_news"
            class="w-full focus-within:z-10"
            @click="tNews('NewsPressreleases')"
          >
            ข่าวประชาสัมพันธ์
          </MenuNewsHome>
          <MenuNewsHome
            :act="'NewsDonation'"
            :link="act.act_submenu_news"
            class="w-full focus-within:z-10"
            @click="tNews('NewsDonation')"
          >
            ข่าวบริจาก
          </MenuNewsHome>
          <MenuNewsHome
            :act="'NewsProcurement'"
            :link="act.act_submenu_news"
            class="w-full focus-within:z-10"
            @click="tNews('NewsProcurement')"
          >
            ข่าวจัดซื้อ/จัดจ้าง
          </MenuNewsHome>
          <MenuNewsHome
            :act="'NewsJob'"
            :link="act.act_submenu_news"
            class="w-full focus-within:z-10"
            @click="tNews('NewsJob')"
          >
            ข่าวรับสมัคร
          </MenuNewsHome>
          <li class="w-full focus-within:z-10">
            <a
              href="#"
              class="inline-block w-full p-4 bg-white border-gray-200 border-s-0 dark:border-gray-700 rounded-e-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
              >งบทดลองระบบ GFMIS</a
            >
          </li>
        </ul>
        <div class="mt-5">
          <div class="grid grid-cols-1 gap-5 md:grid-cols-5">
            <div
              class="w-full"
              v-for="NewsPressrelease in act.news_show"
              :key="NewsPressrelease.id"
            >
              <Link :href="route('News.Press_Release_detail', NewsPressrelease.id)">
                <div
                  class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                >
                  <img
                    v-if="NewsPressrelease.News_type != 'ข่าวจัดซื้อจัดจ้าง'"
                    class="object-cover h-48 rounded-t-lg w-96"
                    :src="NewsPressrelease.News_title_image"
                    alt=""
                  />
                  <div class="p-5">
                    <h5
                      class="mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white line-clamp-2"
                    >
                      {{ NewsPressrelease.News_title }}
                    </h5>
                    <p
                      class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2"
                    >
                      {{ NewsPressrelease.News_detail }}
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

                      <p class="ml-2 c_textsdate">{{ NewsPressrelease.created_at }}</p>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          </div>
          <Link :href="route(act.btn_link, act.btn_link_data)">
            <button
              type="button"
              class="w-full px-3 py-2 mt-6 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              ดูเพิ่มเติม
            </button>
          </Link>
        </div>
      </div>
    </section>

    <section class="section-2 fadeInUp-animation">
      <div class="container mx-auto">
        <div class="mt-20 text-center">
          <p
            class="text-2xl font-semibold leading-normal text-center text-gray-900 dark:text-white"
          >
            ศักยภาพของโรงพยาบาล
          </p>
          <div class="">
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
          </div>
        </div>
        <div class="mt-4">
          <div class="grid grid-cols-1 gap-5 md:grid-cols-5">
            <div class="w-full h-100">
              <div class="w-full text-center h-100">
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="w-12 h-12 text-gray-500"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>
                    <span class="text-xl font-bold text-gray-500">{{
                      potentialdb[0].quantity
                    }}</span>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-gray-500 text-1xl dark:text-white"
                  >
                    จำนวนผู้ป่วยนอกต่อวัน
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="w-12 h-12 text-gray-500"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>
                    <span class="text-xl font-bold text-gray-500">{{
                      potentialdb[1].quantity
                    }}</span>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-gray-500 text-1xl dark:text-white"
                  >
                    ผู้ป่วยนอน รพ. ต่อวัน
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="w-12 h-12 text-gray-500"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                      <circle cx="7" cy="10" r="1" />
                    </svg>
                    <span class="text-xl font-bold text-gray-500">{{
                      potentialdb[2].quantity
                    }}</span>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-gray-500 text-1xl dark:text-white"
                  >
                    จำนวนเตียงผู้ป่วย
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="w-12 h-12 text-gray-500"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>

                    <span class="text-xl font-bold text-gray-500">{{
                      potentialdb[3].quantity
                    }}</span>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-gray-500 text-1xl dark:text-white"
                  >
                    แพทย์ทั้งหมด
                  </h5>
                </a>
              </div>
            </div>
            <div class="w-full text-center h-100">
              <div>
                <a
                  href="#"
                  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                  <center>
                    <svg
                      class="w-12 h-12 text-gray-500"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>
                    <span class="text-xl font-bold text-gray-500">{{
                      potentialdb[4].quantity
                    }}</span>
                  </center>
                  <h5
                    class="mb-2 font-bold tracking-tight text-gray-500 text-1xl dark:text-white"
                  >
                    เจ้าหน้าที่ทั้งหมด
                  </h5>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-3 mt-14 fadeInUp-animation">
      <div class="container mx-auto">
        <div class="mt-5 text-center">
          <p
            class="text-2xl font-semibold leading-normal text-center text-gray-900 dark:text-white"
          >
            ข้อมูลน่าสนใจ
          </p>
          <div class="">
            <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
          </div>
        </div>

        <div class="sm:hidden">
          <label for="tabs" class="sr-only">ข้อมูลน่าสนใจ</label>
          <select
            v-model="act_i.act_submenu_i"
            @change="tInterestinginformation(act_i.act_submenu_i)"
            id="tabs"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full .5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <!-- <MenuNewsHomeResponsive :act="'NewsPressreleases'" :link="act.act_submenu_news" @click="tNews('NewsPressreleases')">ข่าวประชาสัมพันธ์</MenuNewsHomeResponsive>
            <MenuNewsHomeResponsive :act="'NewsDonation'" :link="act.act_submenu_news" @click="tNews('NewsDonation')">ข่าวบริจาก</MenuNewsHomeResponsive> -->
            <option value="Interestinginformation_1">สารสุขภาพ</option>
            <option value="Interestinginformation_2">ประกาศ-นโยบาย-มาตรฐานบริการ</option>
            <option value="Interestinginformation_3">งบทดลองระบบ GFMIS</option>
          </select>
        </div>
        <ul
          class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400"
        >
          <MenuNewsHome
            :act="'Interestinginformation_1'"
            :link="act_i.act_submenu_i"
            class="w-full focus-within:z-10"
            @click="tInterestinginformation('Interestinginformation_1')"
          >
            สารสุขภาพ
          </MenuNewsHome>
          <MenuNewsHome
            :act="'Interestinginformation_2'"
            :link="act_i.act_submenu_i"
            class="w-full focus-within:z-10"
            @click="tInterestinginformation('Interestinginformation_2')"
          >
            ประกาศ-นโยบาย-มาตรฐานบริการ
          </MenuNewsHome>
          <MenuNewsHome
            :act="'Interestinginformation_3'"
            :link="act_i.act_submenu_i"
            class="w-full focus-within:z-10"
            @click="tInterestinginformation('Interestinginformation_3')"
          >
            งบทดลองระบบ GFMIS
          </MenuNewsHome>
        </ul>
        <div class="mt-5">
          <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
            <div
              class="w-full"
              v-for="IPressrelease in act_i.i_show"
              :key="IPressrelease.id"
            >
              <Link
                :href="
                  route(
                    'InterestingInformation.InterestingInformation_detail',
                    IPressrelease.id
                  )
                "
              >
                <div
                  class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                >
                  <img
                    v-if="
                      IPressrelease.interestingInformation_type != 'ข่าวจัดซื้อจัดจ้าง'
                    "
                    class="object-cover h-48 rounded-t-lg w-96"
                    :src="IPressrelease.interestingInformation_title_image"
                    alt=""
                  />
                  <div class="p-5">
                    <h5
                      class="mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white line-clamp-2"
                    >
                      {{ IPressrelease.interestingInformation_title }}
                    </h5>
                    <p
                      class="mb-3 font-normal text-gray-700 dark:text-gray-400 line-clamp-2"
                    >
                      {{ IPressrelease.interestingInformation_detail }}
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
                      <p class="ml-2 c_textsdate">{{ IPressrelease.created_at }}</p>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          </div>
          <Link :href="route(act_i.btn_link, act_i.btn_link_data)">
            <button
              type="button"
              class="w-full px-3 py-2 mt-6 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              ดูเพิ่มเติม
            </button>
          </Link>
        </div>
      </div>
    </section>
  </FontLayout>
</template>
