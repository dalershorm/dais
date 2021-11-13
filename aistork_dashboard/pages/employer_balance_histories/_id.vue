<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div>
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">История баланса</h2>
          <span class="text-gray-800">Список ваших расходов и приходов</span>
        </div>
        <div class="flex">
          <nuxt-link to="/employer_balance_histories/create" class="d-btn d-btn-primary">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="stroke-current text-white" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Добавить</span>
          </nuxt-link>
        </div>
      </div>
    </div>
    
    <div class="">
      <div>
        <vue-good-table
          :columns="columns"
          :rows="rows"
          theme="polar-bear"
          styleClass="vgt-table"
          :search-options="{
            enabled: true,
            placeholder: 'Поиск ...',
          }"
          :pagination-options="{
            enabled: true,
            nextLabel: 'След',
            prevLabel: 'Пред',
            ofLabel: 'из',
            rowsPerPageLabel: 'Строк на странице',
            perPageDropdown: [10, 25, 50, 100],
            allLabel: 'Все',
          }">
          <div slot="emptystate" class="text-center">
            <div class="" v-if="loading">
              <svg class="inline-block animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span>Загрузка...</span>
            </div>
            <span class="text-center" v-else>По вашему запросу ничего не найдено</span>
          </div>
        </vue-good-table>
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
     columns: [
        {
          label: '№',
          field: 'id',
          type: 'number',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
        },
       {
         label: 'Трек код',
         field: 'order.track_code',
         tdClass: 'vgt-center-align',
         thClass: 'vgt-center-align',
       },
       {
         label: 'Стоимость ',
         field: 'cost_china',
         thClass: 'vgt-center-align',
         tdClass: 'vgt-center-align',
       },
        {
         label: 'Дата транзакции ',
         field: 'created_at',
         thClass: 'vgt-center-align',
         tdClass: 'vgt-center-align',
       },
       
      ],
      rows: [],
      loading: false,
      statisticData: {
        all: 0,
        active: 0,
        deactive: 0,
        updated: false
      },
      cities: [],
      filter: {
        phone: '',
        is_active: '',
      },
    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      this.loading = true
      this.$axios.get('/dashboard/pay-histories')
      this.$axios.get('/dashboard/pay-histories')
      .then(res=> {
        this.rows = res.data.pay_histories.filter(el => el.user_id == this.$route.params.id)
        this.loading = false
      })
    },
  }
}
</script>
