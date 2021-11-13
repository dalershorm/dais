<template>
  <div class="">
  <div class="w-full flex h-full">

    <!-- sidebar start -->
    <aside :class="`${showMenu ? 'xl:w-1/5 lg:w-1/3 md:w-1/2 w-3/4' : 'w-0'} inline-block transition-all delay-200`">
      <div :class="`${showMenu ? 'xl:w-1/5 lg:w-1/3 md:w-1/2 w-3/4' : 'w-0'} z-50 fixed transition-all delay-200 top-0 left-0 bg-gray-800 overflow-y-auto bottom-0`">
        <div class="text-center py-6 flex justify-center px-4">
          <nuxt-link to="/">
            <span class="font-bold text-2xl">
              <img src="/img/logo.svg" width="160px" alt="">
            </span>
          </nuxt-link>
          <button @click="showMenu = !showMenu" class="text-white lg:hidden focus:outline-none">
              <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
              </svg>
          </button>
        </div>
        <div class="">
          <div class="mt-2 mx-3">
            <ul>
              <li class="mb-1" v-if="hasPermission('main-show')">
                <nuxt-link to="/" :class="`${ $nuxt.$route.path == '/' ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                  Главная
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('task-show') || hasPermission('order-show') || hasPermission('box-show') || hasPermission('send-show') || hasPermission('reception-dushanbe-show')">
                <a @click="settingShow1 = !settingShow1" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex justify-between cursor-pointer items-center px-2 py-2 text-base font-medium rounded-md">
                  <div class="flex">
                    <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Список задач
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                  </div>
                </a>
                <ul :class="`ml-6 ${settingShow1 ? 'block' : 'hidden'}`">
                  <li class="mb-1" v-if="hasPermission('task-show')">
                    <nuxt-link to="/kanban" exact-active-class="bg-gray-900" class=" text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Все задачи
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('order-show')">
                    <nuxt-link to="/orders" :class="$nuxt.$route.path.startsWith('/orders') ? 'bg-gray-900' : ''" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Прием заказа
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('box-show')">
                    <nuxt-link to="/boxes" :class="$nuxt.$route.path.startsWith('/boxes') ? 'bg-gray-900' : ''" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Упаковка
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('send-show')">
                    <nuxt-link to="/sends"  :class="$nuxt.$route.path.startsWith('/sends') ? 'bg-gray-900' : ''" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Отправка
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('reception-dushanbe-show')">
                    <nuxt-link to="/reception" :class="$nuxt.$route.path.startsWith('/reception') ? 'bg-gray-900' : ''" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Прием в Душанбе
                    </nuxt-link>
                  </li>
                </ul>
              </li>
              <li class="mb-1" v-if="hasPermission('task-show') || hasPermission('order-show') || hasPermission('box-show')">
                <a @click="settingShow = !settingShow" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex justify-between cursor-pointer items-center px-2 py-2 text-base font-medium rounded-md">
                  <div class="flex">
                    <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.445 14.832A1 1 0 0010 14v-2.798l5.445 3.63A1 1 0 0017 14V6a1 1 0 00-1.555-.832L10 8.798V6a1 1 0 00-1.555-.832l-6 4a1 1 0 000 1.664l6 4z"></path></svg>
                    Возврат
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                  </div>
                </a>
                <ul :class="`ml-6 ${settingShow ? 'block' : 'hidden'}`">
                  <li class="mb-1" v-if="hasPermission('order-show')">
                    <nuxt-link to="/returns/orders"  :class="`${ $nuxt.$route.path.startsWith('/returns/orders') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Заказы
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('box-show')">
                    <nuxt-link to="/returns/boxes" :class="`${ $nuxt.$route.path.startsWith('/returns/boxes') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Упаковки
                    </nuxt-link>
                  </li>
                </ul>
              </li>
              <li class="mb-1" v-if="hasPermission('main-show') || hasPermission('main-show') || hasPermission('main-show') || hasPermission('main-show')">
                <a @click="settingShow = !settingShow" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex justify-between cursor-pointer items-center px-2 py-2 text-base font-medium rounded-md">
                  <div class="flex">
                    <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    Склад
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                  </div>
                </a>
                <ul :class="`ml-6 ${settingShow ? 'block' : 'hidden'}`">
                  <li class="mb-1" v-if="hasPermission('main-show')">
                    <nuxt-link to="/warehouse/reception" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      В ожидании
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('main-show')">
                    <nuxt-link to="/warehouse/residue" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Остаток
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('main-show')">
                    <nuxt-link to="/warehouse/shipped" exact-active-class="bg-gray-900" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Оплаченные
                    </nuxt-link>
                  </li>
                </ul>
              </li>
              <hr class="ml-auto my-4">
              <li class="mb-1" v-if="hasPermission('payment-show')">
                <nuxt-link to="/payments" :class="`${ $nuxt.$route.path == '/payments' ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gay-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                  Выдача
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('residue-show') || hasPermission('receipt-show') || hasPermission('expense-show')">
                  <a @click="settingShow3 = !settingShow3" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex justify-between cursor-pointer items-center px-2 py-2 text-base font-medium rounded-md">
                    <div class="flex">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4  w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>                    
                      Касса
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                  </a>
                  <ul :class="`ml-6 ${settingShow3 ? 'block' : 'hidden'}`">
                  <li class="mb-1" v-if="hasPermission('residue-show')">
                    <nuxt-link to="/cashbox/residue" :class="`${ $nuxt.$route.path.startsWith('/cashbox/residue') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Остаток 
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('receipt-show')">
                    <nuxt-link to="/cashbox/receipt" :class="`${ $nuxt.$route.path.startsWith('/cashbox/receipt') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Приход
                    </nuxt-link>
                  </li>
                   <li class="mb-1" v-if="hasPermission('expense-show')">
                    <nuxt-link to="/cashbox/expense" :class="`${ $nuxt.$route.path.startsWith('/cashbox/expense') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Расход
                    </nuxt-link>
                  </li>
                </ul>
              </li>
              <hr class="ml-auto my-4">
              <li class="mb-1" v-if="hasPermission('user-show') || hasPermission('employeer-show')">
                <a @click="settingShow4 = !settingShow4" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex justify-between cursor-pointer items-center px-2 py-2 text-base font-medium rounded-md">
                  <div class="flex">
                    <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Пользователи
                  </div>
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                  </div>
                </a>
                <ul :class="`ml-6 ${settingShow4 ? 'block' : 'hidden'}`">
                  <li class="mb-1" v-if="hasPermission('user-show')">
                    <nuxt-link to="/users" :class="`${ $nuxt.$route.path.startsWith('/users') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Клиенты
                    </nuxt-link>
                  </li>
                  <li class="mb-1" v-if="hasPermission('employeer-show')">
                    <nuxt-link to="/employees" :class="`${ $nuxt.$route.path.startsWith('/employees') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                      <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                      Сотрудники
                    </nuxt-link>
                  </li>
                </ul>
              </li>
              <li class="mb-1" v-if="hasPermission('shipping-show')">
                <nuxt-link to="/deliveries" :class="`${ $nuxt.$route.path.startsWith('/deliveries') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                  Доставки
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('main-show')">
                <nuxt-link to="/posts" :class="`${ $nuxt.$route.path.startsWith('/posts') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                  Записи
                </nuxt-link>
              </li>
              <hr class="ml-auto my-4">
              <li class="mb-1" v-if="hasPermission('balance-history-show')">
                <nuxt-link to="/employer_balance_histories" :class="`${ $nuxt.$route.path.startsWith('/employer_balance_histories') ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                  История баланса
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('direction-show')">
                <nuxt-link to="/directions" :class="`${ $nuxt.$route.path == '/directions' ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                  Направление
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('shipping-show')">
                <nuxt-link to="/shippings" :class="`${ $nuxt.$route.path == '/shippings' ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                  Тип доставки
                </nuxt-link>
              </li>
              <li class="mb-1" v-if="hasPermission('admin-show')">
                <nuxt-link to="/roles" :class="`${ $nuxt.$route.path == '/roles' ? 'bg-gray-900' : ''} text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md`">
                  <svg class="text-gray-400 group-hover:text-gray-300 mr-4 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path></svg>
                  Разрешение
                </nuxt-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </aside>

    <!-- sidebar end -->

    <!-- content start -->
    <main :class="`${showMenu ? 'xl:w-4/5 lg:w-2/3' : 'w-full'} w-full transition-all delay-200 inline-block pb-16 bg-gray-100`">
      <!-- start navbar -->

      <nav class="flex items-center justify-between bg-white">
        <div class="mx-3">
          <button class="p-3 focus:outline-none" @click="showMenu = !showMenu">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <line x1="3" y1="12" x2="21" y2="12"></line>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
          </button>
        </div>
        <div class="">
          <ul class="flex">
            <li class="flex items-center justify-center h-16 w-12 relative">
              <a href="#" @click="userShow = !userShow">
                <span class="absolute top-0 left-0 pt-4">
                  <img class="h-8 w-8 rounded-full shadow" src="/user.svg" alt="avatar">
                </span>
              </a>
              <!-- dropdown content -->
              <div :class="`${userShow ? '' : 'hidden'} dropdown absolute top-0 right-0 mt-16 open border-t-2`">
                <div class="bg-white rounded-b w-48 bottom-end">
                    <div class="flex flex-col w-full">
                      <ul class="list-none">
                          <li class="dropdown-item">
                            <a class="flex flex-row items-center justify-start h-10 w-full px-2" href="/extras/user-profile">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="stroke-current" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="mx-2">Профиль</span>
                            </a>
                          </li>
                          <li class="dropdown-item">
                            <button class="flex flex-row items-center justify-start h-10 w-full px-2" @click="logout">
                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="stroke-current" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                  <polyline points="10 17 15 12 10 7"></polyline>
                                  <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                <span class="mx-2">Выйти</span>
                            </button>
                          </li>
                      </ul>
                    </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- navbar end -->

      <!-- main start -->
        <Nuxt />
      <!-- main end -->

    </main>
    <!-- content end -->

  </div>
</div>

</template>

<script>
export default({
  data() {
    return {
      showMenu: true,
      userShow: false,
      settingShow: false,
      settingShow1: false,
      settingShow2: false,
      settingShow3: false,
      settingShow4: false,
      permissions: []
    }
  },
  mounted() {
    // this.permissions = this.$store.$auth.$state.user.allPermissions
  },
  methods: {
    logout() {
      this.$axios.post('auth/logout')
      .then(res=> {
        window.location.href = "/login"
      })
    },
    hasPermission(perm) {
      return (this.$store.$auth.$state.user.allPermissions.filter(o=> o.name === perm).length > 0 || this.$store.$auth.$state.user.allPermissions.filter(o=> o.name === 'admin-show').length > 0) ? true : false
    }
  }
})
</script>

