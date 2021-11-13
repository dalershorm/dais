<template>
  <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
    <!-- Page title & actions -->
    <div class="max-w-screen-xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 lg:flex lg:justify-between">
      <div class="max-w-xl">
        <h2 class="text-3xl leading-10 font-extrabold text-gray-900 sm:text-4xl sm:leading-none sm:tracking-tight lg:text-5xl">Мои заказы</h2>
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
    <ProfileTable :orders="orders" :empty="isEmpty" />
  </main>

</template>

<script>
export default {
  layout: 'profile',
  data() {
    return {
      track_code: '',
      orders: [],
      isEmpty: false
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    async init() {
      await this.$axios.$get('/profile/get-orders').then((result) => {
          result.orders.length > 0 ? this.orders = result.orders : this.isEmpty = true
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