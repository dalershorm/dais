<template>
    <div class="px-6 w-full relative z-0 overflow-y-auto focus:outline-none" v-if="report">
        <div class="py-8">
          <div class="flex items-center justify-between w-full">
            <div class="">
              <h2 class="md:text-3xl text-xl font-bold text-gray-700 mb-2.5">Ежемесячный Приход</h2>
              <span class="text-gray-800">Режим просмотр ежемесячного прихода.</span>
            </div>
            <div class="flex">
              <nuxt-link to="/cashbox/receipt" class="d-btn d-btn-primary">
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
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900">
                        <span class="mr-3">Карточка прихода: </span>
                        <span class="text-yellow-600">{{ report.id }}</span>
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        Персональная карточка для подробной информации.
                    </p>
                </div>
                
                <button v-if="report.status_id == 18" @click="closeReport(report.id)" type="button" class="bg-green-500 hover:bg-green-600 text-white font-medium focus:outline-none py-2.5 px-5 rounded-full text-sm">
                    Закрыть приход
                </button>
                <button v-else type="button" class="bg-green-200 text-green-800 font-medium focus:outline-none py-2.5 px-5 rounded-full text-sm cursor-not-allowed">
                    Приход закрыт
                </button>
            </div>
            <div class="px-4 py-5 sm:p-0 mb-10">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Номер прихода:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 font-medium sm:mt-0 sm:col-span-2">
                        {{ report.id }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Общий вес:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ report.weight }} (кг)
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Кол-во товаров:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ report.total }} шт
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Общая сумма:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ report.cost }} USD
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Статус прихода:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap"
                            :class="report.status.id == 18 ? 'bg-red-300 text-red-800' : 'bg-green-300 text-green-800'">
                            {{ report.status.name }}
                        </span>
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Дата <span class="lowercase">прихода</span>:
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ moment(String(report.report_date)).format('LLL') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="my-8">
            <h2 class="md:text-2xl text-xl font-bold text-gray-600 mb-2.5">Просмотр содержимого</h2>
        </div>
        
        <TablesOrders :orders="orders" :loading="loading" :isAction="isAction"/>
    </div>
    <div class="flex items-center justify-center flex-1 w-full h-screen" v-else>
        <h1 class="text-2xl text-gray-400 font-medium text-center" v-if="empty">Извините ничего не найдено ...</h1>
        <svg v-else class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</template>

<script>
import moment from 'moment'
import 'moment/locale/ru'

export default {
    data() {
        return {
        moment:moment,
        orders: [],
        report: null,
        loading: true,
        isAction: true,
        empty: false

        }
    },
    mounted(){
        this.init()
    },
    methods: {
        init() {
            this.$axios.get('/dashboard/report-monthly/' + this.$route.params.id)
            .then(res=> {
                this.report = res.data.report
                this.orders = this.report.monthly_report_orders
                this.loading = false
            })
        },
        closeReport(id) {
            this.$axios.post('/dashboard/report-monthly-status/' + id, {status_id: 19})
            .then(res=> {
                this.$swal({
                    icon: 'success',
                    title: 'Успешно',
                    text: 'Приход успешно закрыт',
                    timer: 2000,
                    timerProgressBar: true,
                }).then(res => {
                    this.$router.push({
                        path: '/cashbox/receipt'
                        })
                    })
            }).catch(err => {
                this.$swal({
                    icon: 'erros',
                    title: 'Ошибка',
                    text: "Возникла ошибка при закрытии прихода",
                    timer: 2000,
                    timerProgressBar: true,
                })
            })
        }
    }
}
</script>
