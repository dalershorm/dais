<template>
  <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
    <!-- Page title & actions -->
    <div class="max-w-screen-xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 lg:flex lg:justify-between">
      <div class="max-w-xl">
        <h2 class="text-3xl leading-10 font-extrabold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight lg:text-5xl">Мои доставки</h2>
        <p class="mt-5 text-xl leading-7 text-gray-500">Введите свой <span class="font-medium">трек код</span> товара и узнайте подробнее о вашем товаре сколько весит, где находитcя и т.д</p>
      </div>
      <div class="mt-10 w-full max-w-xs">
        <label for="search" class="block text-base leading-6 font-medium text-gray-500">Поиск товара</label>
        <div class="mt-1.5">
          <form @submit.prevent="findOrder">
            <input type="search" id="search" v-model="track_code" placeholder="Введите трек код" class="appearance-none block w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-base leading-6 text-gray-900 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
          </form>
        </div>
      </div>
    </div>
    <template>
        <div>
            <!-- Projects list (only on smallest breakpoint) -->
            <div class="sm:hidden mt-10">
                <div class="px-4 sm:px-6">
                    <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Последние доставки</h2>
                </div>
                <ul class="mt-3 border-t border-gray-200 divide-y divide-gray-100" v-if="deliveries.length > 0">
                    <li v-for="(item, index) in deliveries" :key="index">
                        <nuxt-link :to="`/profile/deliveries/${item.id}`" class="flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6">
                            <div class="flex items-center truncate space-x-3">
                                <div class="w-2.5 h-2.5 flex-shrink-0 rounded-full" :class="item.status_id == 14 ? 'bg-blue-600' : (item.status_id == 15 ? 'bg-purple-600' : (item.status.id == 16 ? 'bg-yellow-600' : 'bg-green-600'))"></div>
                                <p class="font-medium truncate text-sm leading-6">{{ item.name }} <span class="truncate font-normal text-gray-500">| Воваров: {{ item.delivery_orders.length }} (шт)</span></p>
                            </div>
                            <svg class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </nuxt-link>
                    </li>
                    <nuxt-link to="/profile/deliveries" class="my-5 block w-max mx-auto items-center px-5 py-2 border border-transparent text-sm leading-4 font-medium rounded-full bg-primary-600 bg-opacity-20 text-primary-600 hover:bg-primary-600 hover:bg-opacity-10 focus:outline-none focus:border-primary-100 focus:shadow-outline-purple active:bg-primary-600 active:bg-opacity-10 transition ease-in-out duration-150">
                        Показать больше
                    </nuxt-link>
                </ul>
                <div class="flex items-center justify-center flex-1 w-full my-3 py-3 border-t border-gray-200 divide-y divide-gray-100" v-else>
                    <h1 class="text-md text-gray-500 font-medium text-center" v-if="empty">Извините ничего не найдено ...</h1>
                    <svg v-else class="animate-spin -ml-1 mr-3 h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            <!-- Projects table (small breakpoint and up) -->
            <div class="hidden sm:block mt-8">
                <div class="align-middle inline-block min-w-full border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-t border-gray-200">
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    <span class="lg:pl-2">Ф.И.О</span>
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Телефон
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Адрес
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Кол/во
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Статус
                                </th>
                                <th class="hidden md:table-cell px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Дата добавления
                                </th>
                                <th class="pr-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100" v-if="deliveries.length > 0">
                            <tr v-for="(item, index) in deliveries" :key="index">
                                <td class="px-6 py-3 max-w-0 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    <div class="flex items-center space-x-3 lg:pl-2">
                                        <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full" :class="item.status_id == 14 ? 'bg-blue-600' : (item.status_id == 15 ? 'bg-purple-600' : (item.status.id == 16 ? 'bg-yellow-600' : 'bg-green-600'))"></div>
                                        <nuxt-link :to="`/profile/deliveries/${item.id}`" class="truncate hover:text-gray-600">
                                            <span>{{ item.name }}</span>
                                        </nuxt-link>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-sm leading-5 text-gray-500 font-medium">
                                    {{ item.phone }}
                                </td>
                                <td class="px-6 py-3 text-sm leading-5 text-gray-500 font-medium">
                                    {{ item.address }}
                                </td>
                                <td class="px-6 py-3 text-sm leading-5 text-gray-500 font-medium">
                                    {{ item.delivery_orders.length }} шт
                                </td>

                                <td class="py-3 text-sm leading-5 text-gray-500 font-medium text-center">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" :class="item.status_id == 14 ? 'bg-blue-100 text-blue-800' : (item.status_id == 15 ? 'bg-yellow-100 text-yellow-800' : (item.status.id == 16 ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'))">
                                        {{ item.status.name }}
                                    </span>
                                </td>
                                <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5 text-gray-500 text-right">
                                    {{ moment(String(item.created_at)).format('D MMMM') }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot  v-else>
                            <tr>
                                <td class="px-6 py-3 max-w-0 w-full whitespace-no-wrap text-sm leading-5" colspan="5">
                                    <div class="flex items-center justify-center flex-1 w-full">
                                        <h1 class="text-md text-gray-500 font-medium text-center" v-if="isEmpty">Извините ничего не найдено ...</h1>
                                        <svg v-else class="animate-spin -ml-1 mr-3 h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- <nuxt-link to="/profile/deliveries" class="my-5 block w-max mx-auto items-center px-5 py-2 border border-transparent text-sm leading-4 font-medium rounded-full bg-primary-600 bg-opacity-20 text-primary-600 hover:bg-primary-600 hover:bg-opacity-10 focus:outline-none focus:border-primary-100 focus:shadow-outline-purple active:bg-primary-600 active:bg-opacity-10 transition ease-in-out duration-150">
                    Показать больше
                </nuxt-link> -->
            </div>
        </div>
    </template>

  </main>

</template>

<script>
import moment from 'moment'
import 'moment/locale/ru'

export default {
    layout: 'profile',
    data() {
        return {
            moment: moment,
            track_code: '',
            deliveries: [],
            isEmpty: false
        }
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            await this.$axios.$get('/profile/get-deliveries').then((result) => {
                result.deliveries.length > 0 ? this.deliveries = result.deliveries : this.isEmpty = true
            }).catch((err) => {
                console.log(err)
            });
        },
        findOrder() {
        this.$router.push(`/profile/orders/${this.track_code}`)
        }
    }
}
</script>