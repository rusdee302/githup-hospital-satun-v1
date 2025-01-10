<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { ref } from "vue";
const file = ref(null);
import { Head, Link, useForm } from "@inertiajs/vue3";
const props = defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },

  Newsdb: Object,
});

const form = useForm({
  id: props.Newsdb[0].id,
  interestinginformation_title: props.Newsdb[0].interestingInformation_title,
  interestinginformation_type: props.Newsdb[0].interestingInformation_type,
  interestinginformation_title_image: null,
  interestinginformation_detail: props.Newsdb[0].interestingInformation_detail,
  interestinginformation_images: [],
});

const defImage = useForm({
  Timag: props.Newsdb[0].interestingInformation_title_image,
  Dimag: props.Newsdb[0].interestingInformation_images,
});

const imgviwe = useForm({
  url: null,
  urlmulti: [],
});

console.log(defImage.Dimag);
const onFileChange = (e) => {
  const file = e.target.files[0];
  imgviwe.url = URL.createObjectURL(file);
  // console.log(imgviwe.url);
};

const onFileMultipleChange = (e) => {
  const imgmulti = form.interestinginformation_images;
  let length = imgmulti.length;
  for (let index = 0; index < imgmulti.length; index++) {
    const file = e.target.files[index];
    imgviwe.urlmulti[index] = URL.createObjectURL(file);
  }
  console.log(imgviwe.urlmulti);
};

const onChange = (event) => {
  console.log(event.target.value);
  if (event.target.value == "ข่าวจัดซื้อจัดจ้าง") {
    console.log("d");
    awesome = 0;
  } else {
    awesome = 1;
    console.log("c");
  }
};

const submit = () => {
  if (form.interestinginformation_type == "ข่าวจัดซื้อจัดจ้าง") {
    swal({
      title: "สำเร็จ",
      text: "โพสต์ข่าวสำเร็จ",
      icon: "success",
    }).then(function (value) {
      console.log("returned value:", value);
      if (value) {
      }
    });
    form.post(route("Manage.Minterestinginformation_edit_update"), {});
  } else {
    if (
      form.interestinginformation_title != "" &&
      form.interestinginformation_title_image != "" &&
      form.interestinginformation_images != null &&
      form.interestinginformation_detail != ""
    ) {
      swal({
        title: "สำเร็จ",
        text: "โพสต์ข่าวสำเร็จ",
        icon: "success",
      }).then(function (value) {
        console.log("returned value:", value);
        if (value) {
        }
      });
      form.post(route("Manage.MHealthSubstances_edit_update"), {});
    } else {
      swal({
        title: "ไม่สำเร็จ",
        text: "ข้อมูลไม่ครบ กรุณากรอบข้อมูลให้ครบก่อนบันทึก",
        //icon: "question",
      }).then(function (value) {
        console.log("returned value:", value);
        if (value) {
          // window.location.href = "//www.example.com/apply"
        }
      });
    }
  }
};
</script>

<template>
  <AdminLayout>
    <h1 class="text-2xl font-bold">แก้ไขข้อมูลที่น่าสนใจ</h1>

    <p class="mt-1 text-gray-600">ข้อมูลที่น่าสนใจ / แก้ไขข้อมูลที่น่าสนใจ</p>
    <div class="p-6 mt-4 bg-white">
      <form novalidate @submit.prevent="submit">
        <label
          for="countries"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >ประเภทข่าว</label
        >
        <select
          v-model="form.interestinginformation_type"
          id="countries"
          class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
          <option>สารสุขภาพ</option>
          <option>ประกาศ-นโยบาย-มาตรฐานบริการ</option>
          <option>งบทดลองระบบ GFMIS</option>
        </select>
        <label
          for="message"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >หัวข้อข่าว</label
        >
        <textarea
          v-model="form.interestinginformation_title"
          id="message"
          rows="4"
          class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="หัวข้อข่าว..."
        ></textarea>
        <div v-if="form.interestinginformation_type !== 'ข่าวจัดซื้อจัดจ้าง'">
          <label
            class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="multiple_files"
            >รูปปกข่าว</label
          >
          <input
            @input="form.interestinginformation_title_image = $event.target.files[0]"
            @change="onFileChange"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files"
            type="file"
          />
          <div class="flex">
            <div v-if="imgviwe.url" class="p-2 border-sky-500">
              <p>รูปใหม่</p>
              <img
                v-if="imgviwe.url"
                class="mt-2 border-2 rounded-2xl h-60"
                :src="imgviwe.url"
              />
            </div>
            <div class="p-2 border-sky-500" v-if="defImage.Timag">
              <p>รูปเดิม</p>
              <img
                v-if="defImage.Timag"
                class="mt-2 border-2 rounded-2xl h-60"
                :src="defImage.Timag"
              />
            </div>
          </div>
        </div>
        <label
          class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="multiple_files"
          >รายละเอียดข่าว</label
        >
        <textarea
          v-model="form.interestinginformation_detail"
          id="message"
          rows="9"
          class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="หัวข้อข่าว..."
        ></textarea>
        <div v-if="form.interestinginformation_type !== 'ข่าวจัดซื้อจัดจ้าง'">
          <label
            class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="multiple_files"
            >รูปข่าวทั้งหมด</label
          >
          <input
            @input="form.interestinginformation_images = $event.target.files"
            @change="onFileMultipleChange"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files"
            type="file"
            multiple
          />
          <div v-if="imgviwe.urlmulti[0]" class="p-5 mt-2 rounded-2xl bg-neutral-400">
            <p>รูปใหม่</p>
            <div
              v-if="imgviwe.urlmulti"
              class="grid grid-cols-1 gap-5 mt-2 md:grid-cols-5"
            >
              <div
                v-for="(urlmultis, index) in imgviwe.urlmulti"
                :key="imgviwe.urlmulti"
                class="border-sky-500"
              >
                <img
                  v-if="imgviwe.urlmulti[index]"
                  class="mt-0 border-2 rounded-2xl h-60"
                  :src="imgviwe.urlmulti[index]"
                />
              </div>
            </div>
          </div>
          <div v-if="defImage.Dimag" class="p-5 mt-2 rounded-2xl bg-neutral-300">
            <p>รูปเดิม</p>
            <div v-if="defImage.Dimag" class="grid grid-cols-1 gap-5 mt-2 md:grid-cols-5">
              <div
                v-for="(urlmultis, index) in defImage.Dimag"
                :key="defImage.Dimag"
                class="border-sky-500"
              >
                <img
                  class="mt-0 border-2 rounded-2xl h-60"
                  :src="defImage.Dimag[index]"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="mt-2"></div>
        <span>กรุณาตรวจสอบก่อนกดปุ่ย "โพสต์ข่าว"</span><br />
        <PrimaryButton
          class="w-60"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          โพสต์ข่าว
        </PrimaryButton>
      </form>
    </div>
  </AdminLayout>
</template>
