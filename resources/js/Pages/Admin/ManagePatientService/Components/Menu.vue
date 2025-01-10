<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import ActiveMenu from "@/Pages/Admin/ManagePatientService/Components/ActiveMenu.vue";
</script>

<template>
  <div>
    <div class="grid grid-cols-5 gap-4 mb-4">
      <ActiveMenu
        :href="route('Manage.MDoctorTable')"
        :active="route().current('Manage.MDoctorTable')"
        >ตารางแพทย์ออกตรวจ</ActiveMenu
      >
      <ActiveMenu
        :href="route('Manage.MNews')"
        :active="route().current('Manage.MNews')"
        >ศูนย์สุขภาพมะฮอกกานี (SMC)</ActiveMenu
      >
      <ActiveMenu
        :href="route('Manage.MPatientRoom')"
        :active="route().current('Manage.MPatientRoom')"
        >ห้องพักผู้ป่วย (ห้องพิเศษ)</ActiveMenu
      >
      <ActiveMenu
        :href="route('Manage.MNews')"
        :active="route().current('Manage.MNews')"
        >Mahogany Medical Spa</ActiveMenu
      >
      <ActiveMenu
        :href="route('Manage.MTreatmentForm')"
        :active="route().current('Manage.MTreatmentForm')"
        >แบบฟอร์มขอประวัติการรักษา</ActiveMenu
      >
    </div>
  </div>
</template>
