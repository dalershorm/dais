<template>
  <vue-good-table
    :columns="columns"
    :rows="orders"
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
        <div class="flex justify-around" v-if="props.column.field === 'report_date'">
            <nuxt-link :to="(type_report == 0 ? '/cashbox/receipt/monthly/' : '/cashbox/receipt/daily/')+props.row.id">
                <span>
                    {{ moment(String(props.row.report_date)).format('LL') }}
                </span>
            </nuxt-link>
        </div>
        <div class="flex justify-around" v-else-if="props.column.field === 'action'">
            
            <nuxt-link v-if="type_report" :to="(type_report_date == 0 ? '/cashbox/receipt/monthly/' : '/cashbox/receipt/daily/')+props.row.id"
                class="text-blue-500" title="Просмотреть">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </nuxt-link>

            <nuxt-link v-else :to="(type_report_date == 0 ? '/cashbox/expense/monthly/' : '/cashbox/expense/daily/')+props.row.id"
                class="text-blue-500" title="Просмотреть">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </nuxt-link>
        </div>
        <span v-else-if="props.column.field === 'status.name'">
            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" 
                :class="props.row.status.id == 18 ? 'bg-red-300 text-red-800': 'bg-green-300 text-green-800'">
                {{ props.row.status.name }}
            </span>
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
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table'
import moment from 'moment'
import 'moment/locale/ru'

export default {
    components: {
        VueGoodTable,
    },
    data() {
        return {
            moment: moment,
            columns: [
                {
                    label: 'Дата отчета',
                    field: 'report_date',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
                {
                    label: 'Общая сумма',
                    field: 'cost',
                    thClass: 'vgt-center-align',
                    tdClass: 'vgt-center-align',
                },
                {
                    label: 'Общий вес',
                    field: 'weight',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
                {
                    label: 'Кол-во товаров',
                    field: 'total',
                    thClass: 'vgt-center-align',
                    tdClass: 'vgt-center-align',
                },
                {
                    label: 'Статус',
                    field: 'status.name',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
                {
                    label: 'Действия',
                    field: 'action',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
            ]
        }
    },
    props: ['orders', 'loading', 'type_report', 'type_report_date']
}
</script>
