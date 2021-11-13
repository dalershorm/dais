<template>
    <div class="px-6 w-full relative z-0 overflow-y-auto focus:outline-none" v-if="payment">
        <div class="py-8">
          <div class="flex items-center justify-between w-full">
            <div class="">
              <h2 class="md:text-3xl text-xl font-bold text-gray-700 mb-2.5">Просмотр выдачи</h2>
              <span class="text-gray-800">Режим просмотра.</span>
            </div>
            <div class="flex">
              <nuxt-link to="/payments" class="d-btn d-btn-primary">
                <svg class="stroke-current text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                  <line x1="19" y1="12" x2="5" y2="12"></line>
                  <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Назад</span>
              </nuxt-link>
            </div>
          </div>
        </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    
            <div class="flex justify-between items-center px-4 py-5 bpayment-b bpayment-gray-200 sm:px-6">
                <div>
                    <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900">
                        <span class="mr-3">Карточка выдачи: </span>
                        <span class="text-yellow-600">{{ payment.user.client_code }}</span>
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
                            Имя клиента:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 font-medium sm:mt-0 sm:col-span-2">
                          {{ payment.user.name }}
                        </dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Код клиента:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-yellow-600 font-medium sm:mt-0 sm:col-span-2">
                          {{ payment.user.client_code }}
                        </dd>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Телефон клиента:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-yellow-600 font-medium sm:mt-0 sm:col-span-2">
                          {{ payment.user.phone }}
                        </dd>
                    </div>
                    
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:bpayment-t sm:bpayment-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Вес товара:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ payment.weight }} (кг)
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:bpayment-t sm:bpayment-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Место:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ payment.places }}  (шт)
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:bpayment-t sm:bpayment-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Цена доставки:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ payment.cost }} USD
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:bpayment-t sm:bpayment-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Цена доставки в китае:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ payment.cost_china }} USD
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:bpayment-t sm:bpayment-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Дата выдачи:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(String(payment.updated_at)).format('LLL') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="my-8">
          <h2 class="md:text-2xl text-xl font-bold text-gray-600 mb-2.5">Просмотр содержимого</h2>
      </div>
      <TablesOrders :orders="payment.payment_orders" :loading="loading" :isAction="isAction"/>
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
import moment from 'moment'
import 'moment/locale/ru'

export default {
    layout: 'profile',
    data() {
        return {
            moment: moment,
            payment: null,
            empty: false,
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            await this.$axios.$get(`/dashboard/payments/${this.$route.params.id}`).then((result) => {
                this.payment = result.payment
            }).catch((err) => {
                console.log(err)
            });
        }
    }
}
</script>