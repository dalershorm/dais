<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Отправка</h2>
          <span class="text-gray-800">Список отправленых поставок.</span>
        </div>
        <div class="flex">
          <nuxt-link to="/sends/create" class="d-btn d-btn-primary">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="stroke-current text-white" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Добавить</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    <TablesSends :sends="sends" :loading="loading" :isAction="isAction"/>
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
      sends: [],
      loading: true,
      isAction: true,
    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      this.$axios.get('/dashboard/sends')
      .then(res => {
        this.sends = res.data.sends.filter(el => el.status_id === 12)
        this.loading = false
      })
    }
  }
}
</script>
