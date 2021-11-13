<template>
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" v-if="delivery">
        <div class="bg-white shadow overflow-hidden -mb-8">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900 space-x-3">
                    <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full" :class="delivery.status_id == 14 ? 'bg-blue-600' : (delivery.status_id == 15 ? 'bg-purple-600' : (delivery.status.id == 16 ? 'bg-yellow-600' : 'bg-green-600'))"></div>
                    <span>Карточка доставки: </span>
                    <span class="text-primary-600">{{ delivery.name }}</span>
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                    Персональная карточка для подробной информации.
                </p>
            </div>
            <div class="px-4 py-5 sm:p-0 mb-5">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Ф.И.О:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 font-medium sm:mt-0 sm:col-span-2">
                            {{ delivery.name }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Телефон:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-primary-600 font-medium sm:mt-0 sm:col-span-2">
                            {{ delivery.phone }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Адрес доставки:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ delivery.address }} 
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Кол-во товаров:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ delivery.delivery_orders.length }} шт
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Описание:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ delivery.description || 'Без комментариев' }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Статус товара:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" :class="delivery.status.id == 14 ? 'bg-blue-100 text-blue-800' : (delivery.status.id == 15 ? 'bg-yellow-100 text-yellow-800' : (delivery.status.id == 16 ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'))">
                                {{ delivery.status.name }}
                            </span>
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Дата в <span class="lowercase">{{ delivery.status.name }}</span>:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(String(delivery.updated_at)).format('LLL') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <ProfileTable :orders="delivery.delivery_orders" :isEmpty="isEmpty" class="mb-10" />

    </main>
    <div class="flex items-center justify-center flex-1 w-full" v-else>
        <h1 class="text-2xl text-gray-400 font-medium text-center" v-if="isEmpty">Извините ничего не найдено ...</h1>
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
            delivery: null,
            isEmpty: false,
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            await this.$axios.$get(`/profile/get-deliveries`).then((result) => {
                result.deliveries.length > 0 ? this.delivery = result.deliveries.find(el => el.id == this.$route.params.id) : this.isEmpty = true
            }).catch((err) => {
                console.log(err)
            });
        }
    }
}
</script>