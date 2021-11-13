<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700">Редактировить</h2>
          <!-- <span class="text-gray-800">Список пользователей.</span> -->
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
                  <v-select v-model="order.user" :options="users" label="client_code" />
                  <!--                <input v-model="role.name" type="text" placeholder="Введите название" required="" class="form-control">-->
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Трек код <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="order.track_code" type="text" required=""
                         class="form-control">
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
                  <input v-model="order.cost" type="tel" required="" maxlength="9"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Стоимость доставки в Китае <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.cost_china" type="tel" required="" maxlength="9"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Место <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <input v-model="order.boxes" type="tel" required="" maxlength="9"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Тип доставки <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <select v-model="order.shipping_id" id="installment" class="form-control">
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
                  <select v-model="order.direction_id" id="installment" class="form-control">
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
    vSelect,
  },

  data() {
    return {
      order: {
        user_id: null,
        user: null,
        track_code: null,
        weight: null,
        comment: null,
        cost: null,
        cost_china: null,
        shipping_id: null,
        direction_id: null,
        boxes: null,
        status_id: null,
      },
      loading: false,
      disabled: false,
      directions: [],
      shippings: [],
      users: []
    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      this.$axios.get(`/dashboard/orders/${this.$route.params.id}`)
      .then(res=> {
        this.order = res.data.order
      })

      this.$axios.get('/dashboard/get-data?directions=1&shippings=1&users=1')
          .then(res => {
            this.directions = res.data.directions
            this.shippings = res.data.shippings
            this.users = res.data.users
          })
    },
    uploadFile(event, type = 'avatar') {
      this.loading = true
      this.disabled = true
      if (event.target.files.length > 0) {
        let fd = new FormData()
        fd.append('file', event.target.files[0])
        this.$axios.$post('upload-files/' + type, fd)
        .then(res => {
          this.order[type] = res.filePath
          this.loading = false
          this.disabled = false
        })
      }
    },
    save() {
      if (this.order.user) {
        this.order.user_id = this.order.user.id
      }
      this.$axios.put(`/dashboard/orders/${this.order.id}`, this.order)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/orders'
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
    }
  }
}
</script>
