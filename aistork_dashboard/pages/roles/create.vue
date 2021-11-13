<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700">Добавить</h2>
          <!-- <span class="text-gray-800">Список пользователей.</span> -->
        </div>
        <div class="flex">
          <nuxt-link to="/roles" class="d-btn d-btn-primary">
            <svg class="stroke-current text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            <span>Назад</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    <div class="w-full">
      <div class="w-full">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-4">
          <form class="space-y-6" @submit.prevent="save">
            <div class="flex flex-wrap">
              <div class="w-full md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Название <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="role.name" type="text" placeholder="Введите название" required="" class="form-control">
                </div>
              </div>

              <div class="w-full md:w-1/2 md:px-3 py-2">
                <label class="block text-sm font-medium text-gray-700">
                  Отображаемое имя <span class="text-red-600">*</span>
                </label>
                <div class="mt-1">
                  <input v-model="role.display_name" type="text" placeholder="Введите отображаемое имя" required="" class="form-control">
                </div>
              </div>

              <div class="w-full md:px-3">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                  Доступ <span class="text-red-600">*</span>
                </label>
                  <div>
                    <table class="min-w-full table-auto" v-if="permissionData">
                      <thead class="justify-between">
                        <tr class="bg-gray-800">
                          <th class="px-16 py-2">
                            <span class="text-gray-300">Имя</span>
                          </th>
                          <!-- <th class="px-16 py-2">
                            <span class="text-gray-300">Доступ</span>
                          </th> -->
                         <th class="px-16 py-2">
                           <span class="text-gray-300">Читать</span>
                         </th>
                         <th class="px-16 py-2">
                           <span class="text-gray-300">Написать</span>
                         </th>
                         <th class="px-16 py-2">
                           <span class="text-gray-300">Удаление</span>
                         </th>
                        </tr>
                      </thead>
                      <tbody class="bg-gray-200">
                        <tr class="bg-white border-4 border-gray-200" v-for="(groupPermissions, index) in permissionData" :key="index">
                          <td>
                            <span class="text-center ml-2 font-semibold">{{ groupPermissions[0].display_name }}</span>
                          </td>
                          <td class="px-16 py-2" v-for="(permission, index1) in groupPermissions" :key="index1">
                            <div class="p-3">
                              <div class="flex items-center mr-4 mb-2">
                                <input type="checkbox" v-model="role.permissions" :value="permission.id" class="opacity-0 absolute h-8 w-8" />
                                  <div class="bg-white border-2 rounded-md border-blue-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <svg class="fill-current hidden w-3 h-3 text-blue-600 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero"><path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" /></g></g></svg>
                                  </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                      <!-- <tbody class="bg-gray-200">
                        <tr class="bg-white border-4 border-gray-200" v-for="(groupPermissions, index) in permissions" :key="index">
                          <td>
                            <span class="text-center ml-2 font-semibold">{{ groupPermissions.display_name }}</span>
                          </td>
                          <td class="px-16 py-2">
                            <div class="p-3">
                              <div class="flex items-center mr-4 mb-2">
                                <input type="checkbox" v-model="role.permissions" :value="groupPermissions.id" class="opacity-0 absolute h-8 w-8" />
                                  <div class="bg-white border-2 rounded-md border-blue-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                                    <svg class="fill-current hidden w-3 h-3 text-blue-600 pointer-events-none" version="1.1" viewBox="0 0 17 12" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g transform="translate(-9 -11)" fill="#1F73F1" fill-rule="nonzero"><path d="m25.576 11.414c0.56558 0.55188 0.56558 1.4439 0 1.9961l-9.404 9.176c-0.28213 0.27529-0.65247 0.41385-1.0228 0.41385-0.37034 0-0.74068-0.13855-1.0228-0.41385l-4.7019-4.588c-0.56584-0.55188-0.56584-1.4442 0-1.9961 0.56558-0.55214 1.4798-0.55214 2.0456 0l3.679 3.5899 8.3812-8.1779c0.56558-0.55214 1.4798-0.55214 2.0456 0z" /></g></g></svg>
                                  </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody> -->
                    </table>
                  </div>
              </div>
            </div>

            <div class="w-full md:px-3">
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" classList="rounded bg-bo-primary text-center text-white py-3 px-7 mt-2 w-full md:w-max hover:bg-bo-primary" />
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },

  data() {
    return {
      role: {
        name: '',
        display_name: '',
        permissions: []
      },
      loading: false,
      disabled: false,
      permissions: [],
      permissionData: []
    }
  },
  mounted() {
    this.init()
  },

  methods: {
    init() {
      this.$axios.get('/dashboard/roles')
      .then(res => {
        this.permissions =  res.data.permissions
        let data = []
        this.permissions.filter(o=> o.name.endsWith('-show')).forEach((el, i)=> {
          data[i] = this.permissions.filter(p=> p.name.startsWith(el.name.substr(0, el.name.search('-'))))
        })
        this.permissionData = data
      })
    },
    save() {
      this.$axios.post('/dashboard/roles', this.role)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/roles'
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
