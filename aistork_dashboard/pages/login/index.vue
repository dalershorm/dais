<template>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <img src="/img/logo.svg" width="256px" alt="">
      </div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Авторизация
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="login">
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">
              Телефон
            </label>
            <div class="mt-1">
              <input id="phone" v-model="auth.phone" placeholder="Введите номер телефона" name="phone" type="tel" autocomplete="phone" required="" class="form-control">
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
              Пароль
            </label>
            <div class="mt-1">
              <input id="password" v-model="auth.password" placeholder="Введите пароль" name="password" type="password" autocomplete="current-password" required="" class="form-control">
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                Восстановить пароль
              </a>
            </div>
          </div>
          <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Войти
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  layout: 'login',

  data() {
    return {
       drawer: false,
       loading: false,
       auth: {
           phone: '',
           password: '',
           dashboard: true
       },
       errorMessage: ''
    }
  },
  methods: {
    login() {
         this.errorMessage = ''
         this.loading = true
         this.$auth.loginWith('laravelJWT', {data: this.auth}).then(res=> {
             this.loading = false
             this.$router.push('/')
         }).catch(errors=> {
            this.errorMessage = errors.response.data.message
             this.loading = false
         })
    }
  }
}
</script>
