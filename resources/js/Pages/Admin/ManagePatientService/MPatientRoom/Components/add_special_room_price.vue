<template>
  <div>
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
        v-for="(room, index) in data_room"
        :key="data_room.index"
        class="w-full mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <div>
          <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
          <div class="flex">
            <h5
              class="p-3 mb-2 font-bold tracking-tight text-center text-gray-900 text-1xl dark:text-white"
            >
              {{ room.room_type_th }}
            </h5>
            <svg
                  @click="EditTitle(room.id,room.room_type_th,room.room_type_en)"
                  data-modal-target="Booking-room-title-modal-edit"
                  data-modal-toggle="Booking-room-title-modal-edit"
                  class="w-6 h-6 mt-2 ml-2 text-center text-gray-800 dark:text-white"
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
          </div>
          <div class="flex p-3 bg-slate-100">
            <h5 class="text-3xl font-bold text-center text-gray-500 dark:text-white">
              {{ room.room_price }} บาท
            </h5>
                <svg
                  @click="EditAddress(room.id,room.room_price)"
                  data-modal-target="Booking-room-price-modal-edit-title"
                  data-modal-toggle="Booking-room-price-modal-edit-title"
                  class="w-6 h-6 ml-3 text-center text-gray-800 dark:text-white"
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
          </div>
        </div>
        <div class="p-5">
          <div
            v-for="(room_sub, indexa) in room.room_address_th"
            :key="room.room_address_th.indexa"
          >
            <div class="flex">
              <p class="mb-3 font-normal text-center text-gray-700 dark:text-gray-400">
                {{ room_sub }}
              </p>

              <svg
                @click="
                  ClickEditRoomPriceDetails(
                    indexa,
                    room.id,
                    room_sub,
                    room.room_address_en[indexa]
                  )
                "
                data-modal-target="Booking-room-price-modal-edit"
                data-modal-toggle="Booking-room-price-modal-edit"
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
                @click="submitDeleteAddress(indexa, room.id)"
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
            <hr />
          </div>
          <div class="flex mt-2">
            <button
              @click="AddAddress(room.id)"
              data-modal-target="Booking-room-price-modal-add"
              data-modal-toggle="Booking-room-price-modal-add"
              type="button"
              class="flex px-3 py-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              <svg
                class="w-4 h-4 mr-1 text-white dark:text-white"
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
              เพิ่ม
            </button>
            <button
             @click="deleteAll(room.id)"
              type="button"
              class="flex px-3 py-1 ml-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              <svg
                class="w-4 h-4 mr-1 text-white dark:text-white"
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
              ลบทั้งหมด
            </button>
          </div>
        </div>
      </div>
      <!-- ------------------ form add -------------------- -->

      <div
        v-if="clickOpenForm.form_add === 'y'"
        class="w-full mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <form @submit.prevent="submit">
          <div>
            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />

            <div>
              <h5
                class="p-3 mb-2 font-bold tracking-tight text-gray-900 text-1xl dark:text-white"
              >
                <div class="relative z-0 w-full mb-3 group">
                  <input
                    v-model="roomForm.room_type_th"
                    type="text"
                    name="floating_email"
                    id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >ประเภทห้อง (ภาษาไทย)</label
                  >
                </div>
                <div class="relative z-0 w-full mb-1 group">
                  <input
                    v-model="roomForm.room_type_en"
                    type="text"
                    name="floating_email"
                    id="floating_email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" "
                  />
                  <label
                    for="floating_email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >ประเภทห้อง (อังกฤษ)</label
                  >
                </div>
              </h5>
            </div>
            <div class="p-3 bg-slate-100">
              <div class="relative z-0 w-full mb-1 group">
                <input
                  v-model="roomForm.room_price"
                  type="text"
                  name="floating_email"
                  id="floating_email"
                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=" "
                />
                <label
                  for="floating_email"
                  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                  >ราคา</label
                >
              </div>
              <p class="text-center text-gray-500">บาท</p>
            </div>
          </div>
          <div class="p-5">
            <div v-for="n in forAddAddressForm.address">
              <div class="relative z-0 w-full mb-3 group">
                <input
                  v-model="roomForm.room_address_th[n]"
                  type="text"
                  name="floating_email"
                  id="floating_email"
                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=" "
                />
                <label
                  for="floating_email"
                  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                  >ที่อยู่ห้อง (ภาษาไทย)</label
                >
              </div>
              <div class="relative z-0 w-full mb-3 group">
                <input
                  v-model="roomForm.room_address_en[n]"
                  type="text"
                  name="floating_email"
                  id="floating_email"
                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=" "
                />
                <label
                  for="floating_email"
                  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                  >ที่อยู่ห้อง (อังกฤษ)</label
                >
              </div>
              <hr class="p-3" />
            </div>
            <button
              @click="clickAddAddress()"
              type="button"
              class="px-3 py-2 text-xs font-medium text-center text-white rounded-lg bg-slate-400 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              เพิ่มอาคาร
            </button>
            <button
              @click="clickBackAddress()"
              type="button"
              class="px-3 py-2 ml-2 text-xs font-medium text-center text-white bg-red-400 rounded-lg hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              ถ่อยก่อนหน้านี้
            </button>
            <!-- <button
            type="button"
            class="float-right px-3 py-2 ml-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            บันทึกข้อมูล
          </button> -->
            <PrimaryButton
              data-modal-hide="additional-announcements-room-modal"
              class="float-right w-50"
            >
              + บันทึกข้อมูล
            </PrimaryButton>
          </div>
        </form>
      </div>

      <!-- ------------------- / -------------------------- -->
      <div
        class="w-full mt-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-5 mt-8 text-center">
          <p
            class="mt-3 mb-3 text-2xl font-normal text-center text-gray-700 dark:text-gray-400"
          >
            เพิ่มข้อมูล
          </p>
          <button
            type="button"
            @click="clickAdd(clickOpenForm.form_add)"
            class="text-white bg-slate-400 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >
            <svg
              class="w-16 h-16 text-white-800 dark:text-white"
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

            <span class="sr-only">Icon description</span>
          </button>
        </div>
      </div>
    </div>
  </div>
    <!-- ------------------------ modal title --------------------- -->
    <div
    id="Booking-room-title-modal-edit"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full p-4">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <form @submit.prevent="submitEditTitle">
          <div
            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              แก้ไข ประเภทห้อง
            </h3>
            <button
              type="button"
              class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="Booking-room-title-modal-edit"
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
              >ประเภทห้อง (ภาษาไทย)</label
            >
            <textarea
              v-model="EditTitleForm.e_room_type_th"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ประเภทห้อง (ภาษาไทย)"
            ></textarea>
            <label
              for="message"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >ประเภทห้อง (อังกฤษ)</label
            >
            <textarea
              v-model="EditTitleForm.e_room_type_en"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ประเภทห้อง (อังกฤษ)"
            ></textarea>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
          >
            <PrimaryButton data-modal-hide="Booking-room-title-modal-edit" class="w-50">
              + ยืนยัน
            </PrimaryButton>
            <button
              data-modal-hide="Booking-room-title-modal-edit"
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
  <!-- ------------------------ modal edit --------------------- -->
  <div
    id="Booking-room-price-modal-edit"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full p-4">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <form @submit.prevent="submitEditAddress">
          <div
            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              แก้ไข ขั้นตอนการจองห้อง
            </h3>
            <button
              type="button"
              class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="Booking-room-price-modal-edit"
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
              >ที่อยู่ห้อง (ภาษาไทย)</label
            >
            <textarea
              v-model="roomEditPriceForm.e_room_address_th"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ที่อยู่ห้อง (ภาษาไทย)"
            ></textarea>
            <label
              for="message"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >ที่อยู่ห้อง (อังกฤษ)</label
            >
            <textarea
              v-model="roomEditPriceForm.e_room_address_en"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ที่อยู่ห้อง (อังกฤษ)"
            ></textarea>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
          >
            <PrimaryButton data-modal-hide="Booking-room-price-modal-edit" class="w-50">
              + ยืนยัน
            </PrimaryButton>
            <button
              data-modal-hide="Booking-room-price-modal-edit"
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
  <!-- ------------------------ modal add --------------------- -->
  <div
    id="Booking-room-price-modal-add"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full p-4">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <form @submit.prevent="submitAddAddress">
          <div
            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              เพิ่มที่อยู่ห้อง
            </h3>
            <button
              type="button"
              class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="Booking-room-price-modal-add"
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
              >ที่อยู่ห้อง (ภาษาไทย)</label
            >
            <textarea
              v-model="roomAddPriceForm.a_room_address_th"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ที่อยู่ห้อง (ภาษาไทย)"
            ></textarea>
            <label
              for="message"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >ที่อยู่ห้อง (อังกฤษ)</label
            >
            <textarea
              v-model="roomAddPriceForm.a_room_address_en"
              id="message"
              rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ที่อยู่ห้อง (อังกฤษ)"
            ></textarea>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
          >
            <PrimaryButton data-modal-hide="Booking-room-price-modal-add" class="w-50">
              + ยืนยัน
            </PrimaryButton>
            <button
              data-modal-hide="Booking-room-price-modal-add"
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
    <!-- ------------------------ modal add --------------------- -->
    <div
    id="Booking-room-price-modal-edit-title"
    tabindex="-1"
    aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
  >
    <div class="relative w-full max-w-2xl max-h-full p-4">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->
        <form @submit.prevent="submitEditPrice">
          <div
            class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600"
          >
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              แก้ไขราคา
            </h3>
            <button
              type="button"
              class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="Booking-room-price-modal-edit-title"
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
              >ราคา </label
            >
            <input
              v-model="EditPriceForm.e_room_price"
              id="message"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="ที่อยู่ห้อง (ภาษาไทย)"
            ></input>
          </div>
          <!-- Modal footer -->
          <div
            class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600"
          >
            <PrimaryButton data-modal-hide="Booking-room-price-modal-edit-title" class="w-50">
              + ยืนยัน
            </PrimaryButton>
            <button
              data-modal-hide="Booking-room-price-modal-edit-title"
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
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const showingNavigationDropdown = ref(false);

const props = defineProps({
  data_room: Object,
});

const roomForm = useForm({
  room_type_th: "",
  room_type_en: "",
  room_price: "",
  room_address_th: [],
  room_address_en: [],
});

const clickOpenForm = useForm({
  form_add: "n",
});

const forAddAddressForm = useForm({
  address: 1,
});

const clickAddAddress = () => {
  forAddAddressForm.address++;
};

const clickBackAddress = () => {
  delete roomForm.room_address_th[forAddAddressForm.address];
  delete roomForm.room_address_en[forAddAddressForm.address];
  forAddAddressForm.address--;
};

const clickAdd = (re) => {
  console.log(re);
  if (re == "n") {
    clickOpenForm.form_add = "y";
  } else {
    clickOpenForm.form_add = "n";
    roomForm.room_type_th = "";
    roomForm.room_type_en = "";
    roomForm.room_price = "";
    roomForm.room_address_th = [];
    roomForm.room_address_en = [];
    forAddAddressForm.address = 1;
  }
};

const submit = () => {
  console.log(
    roomForm.room_type_th,
    roomForm.room_type_en,
    roomForm.room_price,
    roomForm.room_address_th,
    roomForm.room_address_en,
    forAddAddressForm.address
  );
  if (roomForm.room_type_th != "") {
    roomForm.post(route("Manage.MPatientRoom_price_insert"), {});
    clickOpenForm.form_add = "n";
    roomForm.room_type_th = "";
    roomForm.room_type_en = "";
    roomForm.room_price = "";
    roomForm.room_address_th = [];
    roomForm.room_address_en = [];
    forAddAddressForm.address = 1;
  }
};
// ----------- edit price
const EditTitleForm = useForm({
  e_id: "",
  e_room_type_th: "",
  e_room_type_en: "",
});

const EditTitle = (id,type_th,type_en) => {
    console.log(id,type_th,type_en);
    EditTitleForm.e_id = id;
    EditTitleForm.e_room_type_th = type_th;
    EditTitleForm.e_room_type_en = type_en;
}

const submitEditTitle = () => {
    EditTitleForm.post(route("Manage.MPatientRoom_title_edit"), {});
};
// ----------- edit price
const EditPriceForm = useForm({
  e_id: "",
  e_room_price: "",
});

const EditAddress = (id,price) => {
    EditPriceForm.e_id = id;
    EditPriceForm.e_room_price = price;
}

const submitEditPrice = () => {
    EditPriceForm.post(route("Manage.MPatientRoom_price_edit"), {});
};
// ---------- edit room

const roomEditPriceForm = useForm({
  e_id: "",
  e_room_key: "",
  e_room_address_th: "",
  e_room_address_en: "",
});

const ClickEditRoomPriceDetails = (ar, id, room_sub_th, room_sub_en) => {
  roomEditPriceForm.e_id = id;
  roomEditPriceForm.e_room_key = ar;
  roomEditPriceForm.e_room_address_th = room_sub_th;
  roomEditPriceForm.e_room_address_en = room_sub_en;
};

const submitEditAddress = () => {
  roomEditPriceForm.post(route("Manage.MPatientRoom_address_edit"), {});
};

const roomDeletePriceForm = useForm({
  e_id: "",
  e_room_key: "",
});

const submitDeleteAddress = (ar, id) => {
  // console.log(ar, id);
  roomDeletePriceForm.e_id = id;
  roomDeletePriceForm.e_room_key = ar;
  roomDeletePriceForm.post(route("Manage.MPatientRoom_address_delete"), {});
};

// --------------- add address

const roomAddPriceForm = useForm({
  a_id: "",
  a_room_address_th: "",
  a_room_address_en: "",
});

const AddAddress = (id) => {
    roomAddPriceForm.a_id = id;
}
const submitAddAddress = () => {
  roomAddPriceForm.post(route("Manage.MPatientRoom_address_add"), {});
};

// ---------------- delete all
const roomDeletaAllForm = useForm({
  e_id: "",
});
const deleteAll = (id) => {
roomDeletaAllForm.e_id = id;
roomDeletaAllForm.post(route("Manage.MPatientRoom_all_delete"), {});
};
// console.log(props.room_booking_details[0]);
</script>
