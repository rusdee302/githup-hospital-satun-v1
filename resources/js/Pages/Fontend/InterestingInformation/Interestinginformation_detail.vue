<template>
  <FontLayout>
    <section
      class="h-auto p-6 section-1 bg-gradient-to-r from-cyan-200 to-blue-200 fadeInUp-animation"
    >
      <div class="container mx-auto">
        <br /><br /><br />
        <br /><br />
        <div class="text-center">
          <h1 class="text-2xl">
            {{ datadb[0].interestingInformation_title }}
          </h1>
        </div>
        <br />
        <br />
      </div>
    </section>
    <section class="section-2 fadeInUp-animation">
      <div class="container mx-auto mt-2">
        <img :src="datadb[0].interestingInformation_title_image" alt="" class="w-full" />
      </div>
    </section>
    <section class="section-3 fadeInUp-animation">
      <div class="container mx-auto mt-6">
        <pre class="text-gray-500 whitespace-pre-line dark:text-gray-400">
            {{ datadb[0].interestingInformation_detail }}
        </pre>
      </div>
    </section>
    <section class="section-4 fadeInUp-animation">
      <div class="container mx-auto mt-6">
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
          <div v-for="Image in Images" :key="Image.id">
            <img class="h-auto max-w-full rounded-lg" :src="Image" alt="" />
          </div>
        </div>
        <div class="mt-6">
          <p>เข้าชม: 175</p>
        </div>
        <div class="p-3 mt-4 bg-gradient-to-r from-cyan-200 to-blue-200">
          <p>ลิงค์สำหรับนำไปเผยแพร่: {{ datadb[0].url_page }}</p>
        </div>
      </div>
    </section>
    <section class="fadeInUp-animation">
      <div>
        <div class="container mx-auto">
          <section class="section-3 mt-9">
            <div class="container mx-auto">
              <div class="mt-5">
                <p
                  class="text-2xl font-semibold leading-normal text-gray-900 dark:text-white"
                >
                  ข่าวประชาสัมพันธ์ที่เกี่ยวข้อง
                </p>
                <div class="">
                  <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700" />
                </div>
              </div>
              <div class="mt-5">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-5">
                  <Link
                    :href="route('News.Press_Release_detail', Newsrelevant.id)"
                    class="w-full"
                    v-for="Newsrelevant in Newsrelevants"
                    :key="Newsrelevant.id"
                  >
                    <div
                      class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                    >
                      <img
                        class="object-cover h-48 rounded-t-lg w-96"
                        :src="Newsrelevant.News_title_image"
                        alt=""
                      />
                      <div class="p-5">
                        <h5
                          class="mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white cus_showtext line-clamp-2"
                        >
                          {{ Newsrelevant.News_title }}
                        </h5>
                        <p
                          class="mb-3 font-normal text-gray-700 dark:text-gray-400 cus_showtext line-clamp-2"
                        >
                          {{ Newsrelevant.News_detail }}
                        </p>
                      </div>
                    </div>
                  </Link>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </FontLayout>
</template>

<script setup>
import FontLayout from "@/Layouts/FontLayout.vue";

import { Link } from "@inertiajs/vue3";

defineProps({
  datadb: Object,
  Images: Object,
  Newsrelevants: Object,
});
</script>
