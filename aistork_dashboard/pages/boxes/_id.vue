<template>
  <div class="px-6" v-if="box">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Просмотр</h2>
          <span class="text-gray-800">Режим просмотр упаковки</span>
        </div>
        <div class="flex">
          <nuxt-link to="/boxes" class="d-btn d-btn-primary">
            <svg class="stroke-current text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Назад</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    <div class="w-full my-5">
      <div class="bg-white shadow sm:rounded-lg" v-if="box">
        <div class="flex justify-between items-center px-4 py-5 border-b border-gray-200 sm:px-6">
          <div>
              <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900">
                  <span class="mr-3">Карточка упаковки: </span>
                  <span class="text-yellow-600">{{ box.name }}</span>
              </h3>
              <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Персональная карточка для подробной информации.
              </p>
          </div>
          <button type="button" class="focus:outline-none bg-yellow-500 text-white px-5 py-2 rounded-lg" onclick="window.print();">Печатать</button>
        </div>
        <div class="px-4 py-5 sm:p-0 mb-10">
            <dl>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Название:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 font-medium sm:mt-0 sm:col-span-2">
                    {{ box.name }}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                    Вес товара:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ box.weight }} (кг)
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                    Место:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ box.orders_count }} (шт)
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Статус упаковки:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                      <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap"
                          :class="box.status.id == 8 ? 'bg-blue-100 text-blue-800' : 
                          (box.status.id == 9 ? 'bg-yellow-100 text-yellow-800' : 
                          (box.status.id == 11 ? 'bg-yellow-300 text-yellow-800' :'bg-green-100 text-green-800'))">
                          {{ box.status.name }}
                      </span>
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Дата <span class="lowercase">{{ box.status.name }}</span>:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ moment(String(box.updated_at)).format('LLL') }}
                    </dd>
                </div>
            </dl>
        </div>
      </div>
    </div>
    <div class="my-8">
        <h2 class="md:text-2xl text-xl font-bold text-gray-600 mb-2.5">Просмотр содержимого</h2>
    </div>
    
    <TablesOrders :orders="orders" :loading="loading" :isAction="isAction"/>
    <TicketsBoxes :box="box"/>

  </div>
  <div class="flex items-center justify-center flex-1 w-full h-screen" v-else>
        <h1 class="text-2xl text-gray-400 font-medium text-center" v-if="empty">Извините ничего не найдено ...</h1>
        <svg v-else class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</template>


<script>
import moment from 'moment';
import 'moment/locale/ru'

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
export default {
  components: {
    vSelect
  },

  data() {
    return {
      moment: moment,
      box: null,
      empty: false,
      orders: [],
      loading: false,
      isAction: true,
      disabled: false,
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    init(){
      this.$axios.get(`/dashboard/boxes/${this.$route.params.id}`).then(res=> {
        this.box = res.data.box
        this.orders = res.data.orders
      })
    },
  }
}
</script>
