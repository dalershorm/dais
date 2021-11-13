<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div>
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Просмот доставки</h2>
          <span class="text-gray-800">Просмотр данных и список товаров которые надо доставить.</span>
        </div>
        <div class="flex">
          <form @submit.prevent="toggleStatus(statuses.on_way)" v-if="delivery.status_id == statuses.created">
              <button type="submit" class="d-btn cursor-pointer focus:outline-none bg-yellow-500">В пути</button>
          </form>
          <form @submit.prevent="toggleStatus(statuses.delivered)" v-else-if="delivery.status_id == statuses.on_way">
            <button type="submit" class="d-btn cursor-pointer focus:outline-none bg-purple-600" >Доставлено</button>          
          </form>
          <form @submit.prevent="toggleStatus(statuses.paid)" v-else-if="delivery.status_id == statuses.delivered">
              <button type="submit" class="d-btn cursor-pointer focus:outline-none bg-green-600">Оплачен</button>
          </form>
        </div>
      </div>
    </div>
    <div class="w-full my-5">
      <div class="bg-white shadow sm:rounded-lg" v-if="delivery">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="flex items-center text-lg leading-6 font-medium text-gray-900">
                <span class="mr-3">Карточка доставки: </span>
                <span class="text-yellow-600">{{ delivery.name }}</span>
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Персональная карточка для подробной информации.
            </p>
        </div>
        <div class="px-4 py-5 sm:p-0 mb-10">
            <dl>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Название:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 font-medium sm:mt-0 sm:col-span-2">
                    {{ delivery.name }}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                    Телефон:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ delivery.phone }}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                    Адрес:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ delivery.address }}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                    Описание:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ delivery.description || 'Без комментариев'}}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Статус доставки:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                      <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap" v-if="delivery.status"
                          :class="delivery.status_id == 14 ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'">
                          {{ delivery.status.name }}
                      </span>
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-gray-500" v-if="delivery.status">
                        Дата <span class="lowercase">{{ delivery.status.name }}</span>:
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ moment(String(delivery.updated_at)).format('LLL') }}
                    </dd>
                </div>
            </dl>
        </div>
      </div>
    </div>
    <div class="my-8">
        <h2 class="md:text-2xl text-xl font-bold text-gray-600 mb-2.5">Просмотр содержимого</h2>
    </div>
    <TablesOrders :orders="orders" :loading="loading"/>

  </div>
</template>

<script>
import moment from 'moment';
import 'moment/locale/ru'
export default {
  data() {
    return {
      moment:moment,
      delivery: [],
      orders: [],
      loading: true,
      statuses: {
        created: 14,
        on_way: 15,
        delivered: 16,
        paid: 17,
      }
    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      this.$axios.get('/dashboard/deliveries/'+this.$route.params.id)
      .then(res=> {
        this.delivery = res.data.delivery
        this.orders = this.delivery.delivery_orders
        this.loading = false
      })
    },
    toggleStatus(delivery_status) {
      this.$axios.put('/dashboard/deliveries/'+this.$route.params.id, {
        status_id: delivery_status
      })
      .then(res=> {
        this.$swal({
          icon: 'success',
          title: 'Успешно',
          text: res.message,
          timer: 2000,
          timerProgressBar: true,
        }).then(res => {
          this.$router.push({
              path: '/deliveries'
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
