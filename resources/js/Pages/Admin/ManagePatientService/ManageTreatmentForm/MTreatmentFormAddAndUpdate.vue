<template>
  <AdminLayout>
    <form @submit.prevent="submitForm" class="space-y-8">
        <input type="text" class="w-full p-2 border border-gray-400"  v-model="form.title">
        <MyEditor v-model="form.content"/>
        <PrimaryButton class="mt-3 w-50"> + เพิ่ม </PrimaryButton>
    </form>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import MyEditor from '@/Components/MyEditor.vue';

const form = useForm({
    title: null,
    content: "<h1>ยินดีตอนรับ</h1><p>คุณรุสดี ลานง</p>",
})
const submitForm = () => {
    console.log(form.content)
}
</script>


