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
    <div class="w-full">
      <div class="w-full">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
          <form class="space-y-6" @submit.prevent="save">
            <div class="flex flex-wrap w-full">
              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Код клиента <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <v-select v-model="order.user" :options="users" label="client_code" :disabled="boxes_mode" />
                  <!--                <input v-model="role.name" type="text" placeholder="Введите название" required="" class="form-control">-->
                </div>
              </div>

              <!-- <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Статус <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <v-select v-model="order.status" :options="statuses" label="name" />
                </div>
              </div> -->

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Трек код <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 relative">
                  <input v-model="order.track_code" type="text" required="" :disabled="boxes_mode" class="form-control disabled:bg-gray-300">
                  <button v-if="!boxes_mode" type="button" @click="generateCode" class="absolute inset-y-0 right-0 focus:outline-none px-3 bg-gray-700 rounded-r text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>                  </button>
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Вес <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.weight" type="tel" required="" maxlength="9"
                      oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                      class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Стоимость доставки <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.cost" type="tel" required="" maxlength="9" :disabled="boxes_mode"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control disabled:bg-gray-300">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Стоимость доставки в Китае
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.cost_china" type="tel" maxlength="9" :disabled="boxes_mode"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control disabled:bg-gray-300">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Место <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.boxes" type="tel" required maxlength="9" :disabled="boxes_mode"
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                    class="form-control disabled:bg-gray-300">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Тип доставки <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <select v-model="order.shipping_id" id="installment" class="form-control disabled:bg-gray-300" :disabled="boxes_mode">
                    <option value="" selected disabled>Выберите тип доставки</option>
                    <option :value="shipping.id" v-for="(shipping, index) in shippings" :key="index">{{ shipping.name }}</option>
                  </select>
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  От куда куда <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <select v-model="order.direction_id" id="installment" class="form-control disabled:bg-gray-300" disabled>
                    <option value="" selected disabled>Выберите от куда куда</option>
                    <option :value="direction.id" v-for="(direction, index) in directions" :key="index">{{ direction.name }}</option>
                  </select>
                </div>
              </div>

              <div class="w-full px-3">
                <label class="block text-sm font-medium text-gray-700">
                  Комментарии
                </label>
                <span class="text-sm text-gray-500">Если у вас есть какое-то описание касательно заявки, пожалуйста поставьте свое описание </span>
                <div class="mt-1">
                  <textarea v-model="order.comment" class="form-control">
                  </textarea>
                </div>
              </div>

            </div>
            <div>
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" classList="rounded bg-bo-primary text-center text-white py-3 px-7 mt-3 lg:ml-3 w-full md:w-max hover:bg-bo-primary" />
            </div>
          </form>
        </div>
      </div>
    </div>
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
      boxes_mode: false,
      boxes_step: 1,
      order: {
        user_id: null,
        user: null,
        track_code: null,
        weight: null,
        comment: null,
        cost: null,
        cost_china: 0,
        shipping_id: null,
        direction_id: this.$auth.user.direction_id,
        boxes: null,
        status_id: 1,
        status: '',
      },
      loading: false,
      disabled: false,
      directions: [],
      shippings: [],
      users: [],
      statuses: []
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    generateCode() {
      let min = Math.ceil(10000000);
      let max = Math.floor(99999999);
      this.order.track_code =  Math.floor(Math.random() * (max - min + 1)) + min;
    },
    init() {
      this.$axios.get('/dashboard/get-data?directions=1&shippings=1&users=1&order_statuses=1')
          .then(res => {
            this.directions = res.data.directions
            this.shippings = res.data.shippings
            this.users = res.data.users
            this.statuses = res.data.order_statuses
          })
    },
    save() {
      let any_track = this.order.track_code + 'A'+this.order.boxes+'-'+this.boxes_step
      if (this.order.user) {
        this.order.user_id = this.order.user.id
      }
      if (this.order.status) {
        this.order.status_id = this.order.status.id
      }
      this.$axios.post('/dashboard/orders', {
          user_id: this.order.user_id,
          user: this.order.user,
          track_code: this.order.boxes >= this.boxes_step ? any_track : this.order.track_code,
          weight: this.order.weight,
          comment: this.order.comment,
          cost: this.order.cost,
          cost_china: this.order.cost_china,
          shipping_id: this.order.shipping_id,
          direction_id: this.order.direction_id,
          boxes: this.order.boxes,
          status_id: this.order.status_id,
          status: this.order.status,
          })
          .then(res => {
            this.$swal({
              icon: 'success',
              title: 'Успешно',
              text: res.message,
              timer: 2000,
              timerProgressBar: true,
            }).then(res => {
              if(this.boxes_step == this.order.boxes) {
                  this.$router.push({
                  path: '/orders'
                })
              } else {
                this.boxes_step += 1
                this.boxes_mode = true
                this.order.weight = null
              }
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
    
  }
}
</script>
