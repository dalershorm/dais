<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between mb-10">
        <div class="">
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Пользователи</h2>
          <span class="text-gray-800">Список пользователей.</span>
        </div>
        <div class="flex">
          <nuxt-link to="/users/create" class="d-btn d-btn-primary">
            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="stroke-current text-white" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Добавить</span>
          </nuxt-link>
        </div>
      </div>
      
      <div class="bg-gray-100 w-full">
        <div class="w-full pb-3">
          <form @submit.prevent="init">
            <dl class="mt-3 grid grid-cols-1 sm:grid-cols-3 items-center bg-white rounded-lg">
              <div class="m-3">
                  <div class="p-2">
                    <dt class="text-sm font-semibold text-gray-700 truncate">
                      Телефон
                    </dt>
                    <dd class="mt-1 text-xl font-semibold text-gray-900">
                      <input v-model="filter.phone" type="text" id="residential_complex" placeholder="Введите телефон" class="form-control">
                    </dd>
                  </div>
              </div>
              <div class="m-3">
                  <div class="p-2">
                    <dt class="text-sm font-semibold text-gray-700 truncate">
                      Статус
                    </dt>
                    <dd class="mt-1 text-xl font-semibold text-gray-900">
                      <select v-model="filter.is_active" id="installment" class="form-control">
                        <option value="" selected>Выберите статус</option>
                        <option :value="1">Активный</option>
                        <option :value="0">Не активный</option>
                      </select>
                    </dd>
                  </div>
              </div>
              <div class="mx-3 mt-5">
                  <div class="flex">
                    <d-button :loading="loading" :disabled="disabled" buttonText="Поиск" classList="mr-3 rounded bg-bo-primary text-center text-white py-3 px-7 w-full md:w-max hover:bg-bo-primary"/>
                    <d-button :onClickEvent="resetForm" buttonText="Сбросить" buttonType="button" classList="rounded bg-gray-600 text-center text-white py-3 px-7 w-full md:w-max hover:bg-bo-primary"/>
                  </div>
               </div>
            </dl>
          </form>
        </div>
      </div>
    </div>
    <div class="">
      <div>
        <vue-good-table
          :columns="columns"
          :rows="rows"
          
          :line-numbers="true"

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
          <template slot="table-row" slot-scope="props">
            <span class="flex justify-center space-x-5" v-if="props.column.field == 'action'">
                <nuxt-link :to="`/users/edit/${props.row.id}`"
                    class="text-blue-500" title="Редактировать">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </nuxt-link>
                <button class="text-red-600"
                        @click="removeItem(props.row)" title="Удалить">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
            </span>
            <span v-else-if="props.column.field == 'is_active'">
                   <span class="text-sm px-3 py-1 rounded-full bg-green-500 text-gray-50" v-if="props.row.is_active==1">активный</span>
                   <span class="text-sm px-3 py-1 rounded-full bg-red-500 text-gray-50" v-else>не активный</span>
              </span>
            <span v-else-if="props.column.field == 'roles'">
                 <span class="text-sm px-3 py-1 rounded-full bg-green-500 text-gray-50" v-for="(role, index) in props.row.roles" :key="index">{{ role.display_name }}</span>
              </span>
          </template>
          <div slot="emptystate" class="text-center">
            <div class="" v-if="loading">
              <svg class="text-gray-600 inline-block animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
          label: 'Имя',
          field: 'name',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
        },
        {
          label: 'Код клиента',
          field: 'client_code',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
        },
        {
          label: 'Телефон',
          field: 'phone',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
        },
        {
          label: 'Статус',
          field: 'is_active',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
        },
       {
          label: 'Действия',
          field: 'action',
          tdClass: 'vgt-center-align',
          thClass: 'vgt-center-align',
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
      this.$axios.get('/dashboard/clients', {
        params: this.filter
      })
      .then(res=> {
        this.rows = res.data.clients
        this.loading = false
        if (!this.statisticData.updated) {
          this.statisticData = {
            all: this.rows ? this.rows.length : 0,
            active: this.rows ? this.rows.filter( o => o.is_active ).length : 0,
            deactive: this.rows ? this.rows.filter( o => !o.is_active ).length : 0,
            updated: true
          }
        }
      })
    },
    removeItem(item) {
      this.$swal({
        icon: 'info',
        title: 'Предупреждение',
        text: 'Вы действительно хотите удалить запись',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Да`,
        denyButtonText: `Нет`,
      }).then(result=> {
        if (result.value) {
          this.$axios.delete('/dashboard/clients/' + item.id)
          .then(res => {
            this.init()
          })
        }
      })
    },
    resetForm() {
      this.filter = {
        name: '',
        phone: '',
        email: '',
        register_date: '',
        city_id: '',
        is_active: '',
      }
      this.init()
    }
  }
}
</script>
