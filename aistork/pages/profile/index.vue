<template>
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
      <!-- Page title & actions -->
      <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
          <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
            Главная
          </h1>
        </div>
      </div>
      <!-- Pinned projects -->
      <div class="px-4 mt-6 sm:px-6 lg:px-8">
        <div class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden md:grid-cols-3">
            <div>
                <div class="px-4 py-5 sm:py-6 sm:pl-0 sm:pr-6">
                    <dl>
                        <dt class="text-base leading-6 font-normal text-gray-900">
                        Заказов в ожидании
                    </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                            <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                                {{ stats.reception_orders }}
                                <span class="ml-2 text-sm leading-5 font-medium text-gray-500">
                                    из {{ stats.ordersCount}}
                                </span>
                            </div>
                            <div class="inline-flex items-baseline px-3 py-0.5 rounded-full text-sm font-medium leading-5  md:mt-2 lg:mt-0" :class="stats.reception_orders_percent <= 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'">
                                <span class="sr-only">
                                    В процентах
                                </span> {{ stats.reception_orders_percent }}%
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="border-t border-gray-200 md:border-0 md:border-l">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-base leading-6 font-normal text-gray-900">
                            В пути.
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                            <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                                {{ stats.send_orders}}
                                <span class="ml-2 text-sm leading-5 font-medium text-gray-500">
                                    из {{ stats.ordersCount}}
                                </span>
                            </div>
                            <div class="inline-flex items-baseline px-3 py-0.5 rounded-full text-sm font-medium leading-5  md:mt-2 lg:mt-0" :class="stats.send_orders_percent <= 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'">
                                <span class="sr-only">
                                    В процентах
                                </span> {{ stats.send_orders_percent }}%
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="border-t border-gray-200 md:border-0 md:border-l">
                <div class="px-4 py-5 sm:p-6">
                    <dl>
                        <dt class="text-base leading-6 font-normal text-gray-900">
                            На складе
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                            <div class="flex items-baseline text-2xl leading-8 font-semibold text-indigo-600">
                                {{ stats.reception_dushanbe}}
                                <span class="ml-2 text-sm leading-5 font-medium text-gray-500">
                                    из {{ stats.ordersCount}}
                                </span>
                            </div>
                            <div class="inline-flex items-baseline px-3 py-0.5 rounded-full text-sm font-medium leading-5  md:mt-2 lg:mt-0" :class="stats.reception_dushanbe_percent <= 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'">
                                <span class="sr-only">
                                    В процентах
                                </span> {{ stats.reception_dushanbe_percent }} %
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <ProfileTable :orders="orders" :empty="isEmpty" />

    </main>
</template>

<script>
export default {
  layout: 'profile',
  data() {
    return {
      orders: [],
      stats: [],
      isEmpty: false
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    async init() {
      
      await this.$axios.$get('/profile/get-statistic').then((result) => {
          this.stats = result
      }),
      await this.$axios.$get('/profile/get-orders').then((result) => {
          result.orders.length > 0 ? this.orders = result.orders : this.isEmpty = true
      }).catch((err) => {
          console.log(err)
      });
    }
  }
}
</script>