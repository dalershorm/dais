<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Остаток</h2>
          <span class="text-gray-800">Список товаров на складе.</span>
        </div>
      </div>
    </div>
    <TablesOrders :orders="orders" :loading="loading"/>
  </div>
</template>

<script>

export default {
  
  data() {
    return {
      orders: [],
      loading: true
    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      this.$axios.get('/dashboard/get-data?orders=6')
      .then(res=> {
        this.orders = res.data.orders
        this.loading = false
      })
    }
  }
}
</script>
