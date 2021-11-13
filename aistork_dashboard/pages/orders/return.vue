<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Возврат</h2>
          <span class="text-gray-800">Процесс возврата товара</span>
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
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
        <form @submit.prevent="save">
            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700" id="find-boxes">
                <p class="mb-2.5 block">Трек код товара<span class="text-red-600">*</span></p> 
                </label>
                <v-select @input="selectOrders" :options="orders" label="track_code" multiple/>
            </div>
            <div class="md:px-3 w-full">
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" classList="rounded bg-bo-primary text-center text-white py-3 px-7 mt-3 w-full md:w-max hover:bg-bo-primary" />
            </div>
        </form>
      </div>
    </div>
    <div class="my-8">
        <h2 class="md:text-2xl text-xl font-bold text-gray-600 mb-2.5">Просмотр содержимого</h2>
    </div>
    <TablesOrders :orders="dump_orders" :loading="loading" :isAction="isAction"/>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
  components: {
    vSelect
  },

  data() {
    return {
      box: {
        status: '',
        status_id: 8,
        orders: []
      },
      dump_orders: [],
      loading: false,
      disabled: false,
      statuses: [],
      orders: [],
      isAction: 1
    }
  },

  mounted() {
    this.$axios.get('/dashboard/get-data?box_statuses=1&orders=1')
      .then(res => {
        this.statuses = res.data.box_statuses
        this.orders = res.data.orders
      })
  },
  methods: {
    save() {
      if (this.box.status) {
        this.box.status_id = this.box.status.id
      }
      this.$axios.post('/dashboard/boxes', this.box)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/boxes'
          })
        })
      })
      .catch(err=> {
        this.$swal({
          icon: 'erros',
          title: 'Ошибка',
          text: err.response.data[Object.keys(err.response.data)[0]][0],
          timer: 2000,
          timerProgressBar: true,
        })
      })
    },
    selectOrders (data) {
      this.dump_orders = data
      this.box.orders = data.map(o => o.id)
    }
  }
}
</script>
