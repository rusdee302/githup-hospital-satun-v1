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
                        แบบฟอร์มขอประวัติการรักษา
                    </h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">
                        จัดการข้อมูลแบบฟอร์มขอประวัติการรักษา
                    </p>
                </div>
            </div>
            <MPatientServiceMenu></MPatientServiceMenu>
            <div>
                <div
                    class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                >
                    <div class="flex justify-end">
                        <button
                            data-modal-target="static-modal"
                            data-modal-toggle="static-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button"
                        >
                            อัพเดทข้อมูล
                        </button>
                    </div>
                    <hr class="mt-2" />
                    <div class="my-8 prose max-w-none" v-html="props.treatment_forms[0].detail"></div>
                </div>
            </div>
        </div>
    </AdminLayout>

    <!-- Main modal -->
    <div
        id="static-modal"
        data-modal-backdrop="static"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-h-full p-4 max-w-7xl">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        อัพเดทข้อมูล
                    </h3>
                    <button
                        type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal"
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
                <!-- <form @submit.prevent="submitForm" class="space-y-8"> -->
                <div class="p-4 space-y-4 md:p-5">
                    <MyEditor v-model="form.content" />
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
                >
                    <PrimaryButton class="mt-0 w-50" @click="submitForm">
                        อัพเดท
                    </PrimaryButton>
                    <button
                        data-modal-hide="static-modal"
                        type="button"
                        class="px-5 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ms-3 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    >
                        ยกเลิก
                    </button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { Link, router, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import MyEditor from '@/Components/MyEditor.vue'
import MPatientServiceMenu from '@/Pages/Admin/ManagePatientService/Components/Menu.vue'


const props = defineProps({
    treatment_forms: Object,
})

const form = useForm({
    title: null,
    content: props.treatment_forms[0].detail,
})

console.log(props.treatment_forms[0].detail)
const submitForm = () => {
    console.log(form.content)
    form.post(route('Manage.MTreatmentFormUpdate'), {})
}
</script>
