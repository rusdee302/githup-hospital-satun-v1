<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { ref } from "vue";
const file = ref(null);
import { Head, Link, useForm } from "@inertiajs/vue3";
defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const form = useForm({
  interestinginformation_title: "",
  interestinginformation_type: "",
  interestinginformation_title_image: null,
  interestinginformation_detail: "",
  interestinginformation_images: [],
});

const imgviwe = useForm({
  url: null,
  urlmulti: [],
});

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
    form.post(route("Manage.MHealthSubstances_create_insert"), {});
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
      form.post(route("Manage.MHealthSubstances_create_insert"), {});
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
    <h1 class="text-2xl font-bold">เพิ่มข้อมูลที่น่าสนใจ</h1>

    <p class="mt-1 text-gray-600">ข้อมูลที่น่าสนใจ / เพิ่มข้อมูลที่น่าสนใจ</p>
    <div class="p-6 mt-4 bg-white">
      <form novalidate @submit.prevent="submit">
        <label
          for="countries"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >ประเภทข้อมูลน่าสนใจ</label
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
          >หัวข้อ ข้อมูลน่าสนใจ</label
        >
        <textarea
          v-model="form.interestinginformation_title"
          id="message"
          rows="4"
          class="p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="หัวข้อ ข้อมูลน่าสนใจ..."
        ></textarea>
        <div v-if="form.interestinginformation_type !== 'ข่าวจัดซื้อจัดจ้าง'">
          <label
            class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white"
            for="multiple_files"
            >รูปปกข้อมูลน่าสนใจ</label
          >
          <input
            @input="form.interestinginformation_title_image = $event.target.files[0]"
            @change="onFileChange"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files"
            type="file"
          />
          <div v-if="imgviwe.url" class="p-2 border-sky-500">
            <img
              v-if="imgviwe.url"
              class="mt-2 border-2 rounded-2xl h-60"
              :src="imgviwe.url"
            />
          </div>
        </div>
        <label
          class="block mt-2 mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="multiple_files"
          >รายละเอียดข้อมูลน่าสนใจ</label
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
            >รูปข้อมูลน่าสนใจทั้งหมด</label
          >
          <input
            @input="form.interestinginformation_images = $event.target.files"
            @change="onFileMultipleChange"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files"
            type="file"
            multiple
          />
          <div class="grid grid-cols-1 gap-5 mt-2 md:grid-cols-5">
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
        <div class="mt-2"></div>
        <span>กรุณาตรวจสอบก่อนกดปุ่ย "บันทึก"</span><br />
        <PrimaryButton
          class="w-60"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          บันทึก
        </PrimaryButton>
      </form>
    </div>
  </AdminLayout>
</template>
