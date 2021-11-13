<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Добавить</h2>
          <span class="text-gray-800">Процес добавление упаковок в отправку</span>
        </div>
        <div class="flex">
          <nuxt-link to="/sends" class="d-btn d-btn-primary">
            <svg class="stroke-current text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Назад</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    <div class="w-full my-5">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
        <form @submit.prevent="save">
          <div>
            <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Название <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <input v-model="send.name" type="text" placeholder="Введите название" required="" class="form-control">
              </div>
            </div>
            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700" id="find-boxes">
                <p class="mb-2.5 block">Трек код Упаковки<span class="text-red-600">*</span></p> 
                </label>
                <v-select @input="selectOrders" :options="boxes" label="name" multiple/>
            </div>
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
    <TablesBoxes :boxes="dump_boxes" :loading="loading" :isAction="isAction"/>
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
      send: {
        name: '',
        status: '',
        status_id: 12,
        boxes: []
      },
      dump_boxes: [],
      isAction: true,
      loading: false,
      disabled: false,
      statuses: [],
      boxes: []
    }
  },

  mounted() {
    this.$axios.get('/dashboard/get-data?send_statuses=1&boxes=8')
        .then(res => {
          this.statuses = res.data.send_statuses
          this.boxes = res.data.boxes
        })
  },
  methods: {
    save() {
      if (this.send.status) {
        this.send.status_id = this.send.status.id
      }
      this.$axios.post('/dashboard/sends', this.send)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/sends'
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
      this.dump_boxes = data
      this.send.boxes = data.map(o => o.id)
    }
  }
}
</script>
