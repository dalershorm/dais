<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700">Редактировать</h2>
          <!-- <span class="text-gray-800">Список пользователей.</span> -->
        </div>
        <div class="flex">
          <nuxt-link to="/statuses" class="d-btn d-btn-primary">
            <svg class="stroke-current text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Назад</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    <div class="w-full">
      <div class="w-full">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
          <form class="flex flex-wrap w-full" @submit.prevent="save">

            <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Название <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <input v-model="status.name" type="text" placeholder="Введите название" required="" class="form-control">
              </div>
            </div>

            <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Источник <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <select v-model="status.status_resource_id" id="installment" class="form-control">
                  <option value="" selected disabled>Ресурс</option>
                  <option :value="index" v-for="(resource, index) in resources" :key="index">{{ resource.name }}</option>
                </select>
              </div>
            </div>

            <div class="md:px-3 w-full">
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" classList="rounded bg-bo-primary text-center text-white py-3 px-7 mt-3 w-full md:w-max hover:bg-bo-primary" />
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';

export default {
  components: {
    VueGoodTable,
  },

  data() {
    return {
      status: {
        name: '',
        status_resource_id: ''
      },
      loading: false,
      disabled: false,
      resources: []
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    init(){
      this.$axios.get(`/dashboard/statuses/${this.$route.params.id}`)
      .then(res=> {
        this.status = res.data.status
        this.resources = res.data.resources
      })
    },
    save() {
      this.$axios.put(`/dashboard/statuses/${this.$route.params.id}`, this.status)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/statuses'
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
