<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Добавить</h2>
          <span class="text-gray-800">Процес добавление товара.</span>
        </div>
        <div class="flex">
          <nuxt-link to="/orders" class="d-btn d-btn-primary">
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
    <div class="w-full bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
        <form @submit.prevent="save">
          <ul class="grid grid-cols-1 divide-y">
            <li class="flex items-center justify-between py-5">
                <span class="font-medium">Код клиента: </span> 
                <div class="w-full lg:w-1/3 md:w-1/2 md:px-3">
                  <v-select v-model="payment.user" :options="users" label="client_code" />
                </div>         
            </li>
            
            <li class="py-5">
                <nav class="flex items-center justify-between">
                    <span class="font-medium">Введите трек коды: </span> 
                    <div class="w-full lg:w-1/3 md:w-1/2 md:px-3" v-if="payment.user">
                      <v-select @input="selectOrders" :options="orders.filter(el => el.user_id == payment.user.id)" label="track_code" :disabled="!payment.user" multiple/>
                    </div>
                    <div class="w-full lg:w-1/3 md:w-1/2 md:px-3" v-else>
                      <v-select @input="selectOrders" :options="orders" label="track_code" :disabled="true" multiple/>
                    </div>    
                </nav>
            </li>
            <li class="flex items-center justify-between py-5">
                <span class="font-medium">Общий вес: </span> <span class="text-base"> {{ payment.weight }} <span class="font-medium">(кг)</span></span>
            </li>
            <li class="flex items-center justify-between py-5">
                <span class="font-medium">Места: </span> <span class="text-base"> {{ payment.places }} <span class="font-medium">(шт)</span></span>
            </li>
            <li class="flex items-center justify-between py-5">
                <span class="font-medium">Стоимость доставки в Китае: </span> <span class="text-base">{{ payment.cost_china }} <span class="font-medium">USD</span></span>
            </li>
            <li class="flex items-center justify-between py-5">
              <span class="font-medium">Стоимость доставки компании: </span> <span class="text-base">{{ payment.cost }} <span class="font-medium">USD</span></span>
            </li>
            <li class="flex items-center justify-between py-5">
              <span class="font-medium text-xl">Итого: </span> <strong>{{ payment.total }} <span class="font-medium">USD</span></strong>
            </li>
            <li class="flex items-center justify-between py-5">
                <div class="col-6">
                    <button type="submit" class="rounded bg-bo-primary text-center text-white py-3 px-7 mt-3 lg:ml-3 w-full md:w-max hover:bg-bo-primary">
                        Сохранить
                    </button>
                </div>
                <div class="col-6 text-right">
                    <p class="font-semibold h3">Спасибо за покупку !</p>
                    <small>Дата / время: <strong> {{ moment().format('L | LTS') }} </strong></small>
                </div>
            </li>
          </ul>
        </form>
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
import moment from 'moment';
import 'moment/locale/ru'

export default {
  components: {
    vSelect
  },
  data() {
    return {
      moment:moment,
      payment: {
        user_id: null,
        user: null,
        orders: null,
        weight: 0,
        cost: 0,
        cost_china: 0,
        places: 0,
        total: 0,
      },
      orders: [],
      dump_orders: [],
      loading: false,
      disabled: false,
      users: [],
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    init() {
      this.$axios.get('/dashboard/get-data?users=1').then(res => { this.users = res.data.users })
      this.$axios.get('/dashboard/payments?orders=1').then(res => { this.orders = res.data.orders })
    },
    save() {
      if (this.payment.user) {
        this.payment.user_id = this.payment.user.id
      }
      this.$axios.post('/dashboard/payments', this.payment)
          .then(res => {
            this.$swal({
              icon: 'success',
              title: 'Успешно',
              text: res.message,
              timer: 2000,
              timerProgressBar: true,
            }).then(res => {
                this.$router.push({
                path: '/payments'
              })
            })
          })
          .catch(err => {
            this.$swal({
              icon: 'erros',
              title: 'Ошибка',
              text: err.response.data.message ? err.response.data.message : err.response.data[Object.keys(err.response.data)[0]][0],
              timer: 2000,
              timerProgressBar: true,
            })
          })
    },
    selectOrders (data) {
      this.dump_orders = data
      this.payment.orders = data.map(el => el.id)
      this.payment.weight = data.map(el => el.weight).reduce((a,b) => a + b)
      this.payment.cost = data.map(el => el.cost).reduce((a,b) => a + b)
      this.payment.cost_china = data.map(el => el.cost_china).reduce((a,b) => a + b)
      this.payment.places = data.length
      this.payment.total = this.payment.cost + this.payment.cost_china
    }
    
  }
}
</script>
