<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700">Добавить</h2>
          <!-- <span class="text-gray-800">Список пользователей.</span> -->
        </div>
        <div class="flex">
          <nuxt-link to="/employees" class="d-btn d-btn-primary">
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
                  Имя <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="employer.name" type="text" required=""
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Телефон <span class="text-red-600">*</span>
                </label>
                <div class="mt-1 flex">
                  <span class="w-20 pt-2 pl-2 bg-gray-300 rounded-tl rounded-bl">+992</span>
                  <input v-model="employer.phone" type="tel" required="" maxlength="9"
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Пароль <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="employer.password" type="password" minlength="8" required=""
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Подтвердить пароль <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="employer.password_confirmation" type="password" minlength="8" required=""
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Статус <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <select v-model="employer.is_active" id="installment" class="form-control">
                    <option value="" selected disabled>Выберите статус</option>
                    <option :value="1">Активный</option>
                    <option :value="0">Не активный</option>
                  </select>
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Баланс <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="employer.balance" type="text" required=""
                         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                         class="form-control">
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Описание баланса
                </label>
                <div class="mt-1">
                  <textarea v-model="employer.description" type="text" required=""
                         class="form-control"></textarea>
                </div>
              </div>

              <div class="w-full lg:w-1/3 md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Доступ <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <v-select multiple v-model="employer.roles" :options="roles" label="display_name" />
                  <!--                <input v-model="role.name" type="text" placeholder="Введите название" required="" class="form-control">-->
                </div>
              </div>
            </div>
            <div class="tabs px-5">
              <div class="mt-6">
            <span class="block text-xl font-semibold bo-gray-600 mb-4"
            >Добавьте аватар <span class="text-red-700">*</span></span
            >
                <div class="grid grid-cols-8 gap-5">
                  <div class="row-span-2 col-span-2 relative group">
                    <label for="image" class="cursor-pointer"
                    ><img
                        :src="employer.avatar ? $axios.defaults.baseURL.replace('/api', '') + employer.avatar : '/img/upload_plus.svg'"
                        class="w-full h-full"
                    /></label>
                    <input type="file" id="image" class="hidden"
                           accept="image/*"
                           multiple
                           @change="uploadFile"/>
                  </div>
                </div>
                <div class="notes-upload mt-9">
                  <small class="block mb-3 text-bo-gray-400"
                  >Максимальный размер файла не должен превышать 5МБ, формат
                    изображений: .jpg, .jpeg, .png, .gif</small>
                </div>
              </div>
            </div>
            <div>
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" classList="rounded bg-bo-primary text-center text-white py-3 px-7 mt-3 ml-3 w-full md:w-max hover:bg-bo-primary" />
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
      years: [],
      cities: {},
      employer: {
        employer: 1,
        name: '',
        phone: '',
        password: '',
        password_confirmation: '',
        is_active: 0,
        roles: [],
        avatar: '',
        balance: 0,
        description: ''
      },
      loading: false,
      disabled: false,
      roles: []
    }
  },
  mounted() {
    this.init()
    for (let i = 2000; i <= new Date().getFullYear(); i++) {
      this.years.push(i)
    }
  },
  methods: {
    init() {
      this.$axios.get('/get-data?onlyCities=1')
          .then(res => {
            this.cities = res.data.onlyCities
          })
      this.$axios.get('/dashboard/roles')
          .then(res => {
            this.roles = res.data.roles
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
              this.employer[type] = res.filePath
              this.loading = false
              this.disabled = false
            })
      }
    },
    save() {
      this.$axios.post('/dashboard/employees', this.employer.user_type ? this.employer : this.employer)
          .then(res => {
            this.$swal({
              icon: 'success',
              title: 'Успешно',
              text: res.message,
              timer: 2000,
              timerProgressBar: true,
            }).then(res => {
              this.$router.push({
                path: '/employees'
              })
            })
          })
          .catch(err => {
            this.$swal({
              icon: 'erros',
              title: 'Ошибка',
              text: err.response.data[Object.keys(err.response.data)[0]][0],
              timer: 2000,
              timerProgressBar: true,
            })
          })
    },
  }
}
</script>
