<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700">Редактировать</h2>
          <!-- <span class="text-gray-800">Список пользователей.</span> -->
        </div>
        <div class="flex">
          <nuxt-link to="/top_questions" class="d-btn d-btn-primary">
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

            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Название <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <input v-model="top_question.title" type="text" placeholder="Введите название" required="" class="form-control">
              </div>
            </div>
            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Описание <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <textarea v-model="top_question.description" type="text" placeholder="Введите название" required="" class="form-control"></textarea>
              </div>
            </div>
            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Язык <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <select v-model="top_question.lang" class="form-control" required>
                  <option value="ru">русский</option>
                  <option value="tj">Таджикский</option>
                </select>
              </div>
            </div>
            <div class="w-full md:px-3 py-2">
              <label class="block text-sm font-medium text-gray-700">
                Статус <span class="text-red-600">*</span>
              </label>
              <div class="mt-1">
                <select v-model="top_question.status" class="form-control" required>
                  <option value="0">не активный</option>
                  <option value="1">активный</option>
                </select>
              </div>
            </div>
            <div class="md:px-3">
              <d-button :loading="loading" :disabled="disabled" buttonText="Сохранить" />
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
      top_question: {
        name: ''
      },
      loading: false,
      disabled: false,
    }
  },
  mounted() {
    this.init()
  },
  methods: {
    init(){
      this.$axios.get(`/dashboard/top_questions/${this.$route.params.id}`)
      .then(res=> {
        this.top_question = res.data.top_question
      })
    },
    save() {
      this.$axios.put(`/dashboard/top_questions/${this.$route.params.id}`, this.top_question)
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/top_questions'
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
