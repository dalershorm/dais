<template>
  <vue-good-table
    :columns="columns"
    :rows="sends"
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
        <div class="flex justify-around" v-if="props.column.field === 'action'">
            <nuxt-link :to="`/sends/${props.row.id}`"
                class="text-blue-500" title="Просмотреть">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </nuxt-link>
            <div v-if="!isAction">
                <nuxt-link :to="`/sends/edit/${props.row.id}`"
                        v-if="props.row.status_id === 12"
                        class="text-yellow-500" title="Редактировать">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </nuxt-link>
            </div>
            <div v-if="!isAction">
                <button type="button" class="text-red-600"
                        v-if="$store.$auth.$state.user.allPermissions.filter(o=> o.name === 'admin-read').length > 0 || $store.$auth.$state.user.allPermissions.filter(o=> o.name === 'order-read').length > 0"
                        @click="removeItem(props.row)" title="Удалить">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                </button>
            </div>
           
        </div>
        <span v-else-if="props.column.field === 'status.name'">
            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" 
                :class="props.row.status.id == 12 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'">
                {{ props.row.status.name }}
            </span>
        </span>
        <span v-else-if="props.column.field === 'orders_count'">
            <span class="text-sm">{{ props.row.orders.length }} </span>
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
import { VueGoodTable } from 'vue-good-table';

export default {
    components: {
        VueGoodTable,
    },
    data() {
         return {
            columns: [
                
                {
                    label: 'Название',
                    field: 'name',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
                {
                    label: 'Место',
                    field: 'boxes_count',
                    tdClass: 'vgt-center-align',
                    thClass: 'vgt-center-align',
                },
                {
                    label: 'Статус',
                    field: 'status.name',
                    type: 'string',
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
    methods: {
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
                this.$axios.delete('/dashboard/sends/' + item.id)
                .then(res => {
                    this.sends = this.sends.splice(this.sends.findIndex(el => el.id === item.id), 1)
                })
                }
            })
        }
    },
    props: ['sends', 'loading', 'isAction']
}
</script>
