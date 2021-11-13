<template>
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" v-if="order">
        <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900 space-x-3">
                    <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full" :class="order.status_id == 1 ? 'bg-blue-600' : (order.status_id == 2 ? 'bg-purple-600' : (order.status.id == 3 ? 'bg-yellow-600' : 'bg-green-600'))"></div>
                    <span>Карточка товара: </span>
                    <span class="text-primary-600">{{ order.track_code }}</span>
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                    Персональная карточка для подробной информации.
                </p>
            </div>
            <div class="px-4 py-5 sm:p-0 mb-10">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Код клиента:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 font-medium sm:mt-0 sm:col-span-2">
                        {{ order.user.client_code }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Трек код:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-primary-600 font-medium sm:mt-0 sm:col-span-2">
                        {{ order.track_code }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Вес товара:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ order.weight }} (кг)
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Место:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ order.boxes }} 
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Цена доставки:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ order.cost }} USD
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Цена доставки в китае:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ order.cost_china }} USD
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Описание:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ order.comment || 'Без комментариев' }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Отправленно:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ order.shipping.name }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Статус товара:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" :class="order.status_id == 1 ? 'bg-blue-100 text-blue-800' : (order.status_id == 2 ? 'bg-purple-100 text-purple-800' : (order.status.id == 3 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'))">
                            {{ order.status.name }}
                        </span>
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Дата <span class="lowercase">{{ order.status.name }}</span>:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(String(order.updated_at)).format('LLL') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </main>
    <div class="flex items-center justify-center flex-1 w-full" v-else>
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
            order: null,
            empty: false,
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            await this.$axios.$get(`/profile/find-order?track_code=${this.$route.params.track_code}`).then((result) => {
                result.orders.length > 0 ? this.order = result.orders[0] : this.empty = true
            }).catch((err) => {
                console.log(err)
            });
        }
    }
}
</script>