<template>
   <div>
      <div class="flex items-center justify-center h-80 sm:96 px-5" v-if="orders.length === 0">
         <h3 class="text-center mt-2 mb-8 text-2xl leading-8 font-medium tracking-tight text-gray-400 sm:text-2xl sm:leading-10">Извините у вас нет пока прибывших товаров ...
         </h3>
      </div>
      <div class="mt-8 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8" v-else>
         <div class="md:grid grid-cols-5 gap-6 justify-between items-center">
            <div class="sm:flex sm:flex-col sm:align-left col-span-2">
               <h1 class="text-5xl leading-none font-extrabold text-gray-900 sm:text-left">Услуга доставки</h1>
               <p class="mt-5 text-xl leading-7 text-gray-500 sm:text-left">Это раздел доставки ваших товаров прибывших в душанбе, заполните форму и введите трек код ваших товаров.</p>
            </div>
            <div class="mt-5 md:mt-0 col-span-3 w-4/5 mx-auto">
                  <form method="POST" @submit.prevent="createDelivery">
                     <div class="overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                              <div class="grid grid-cols-6 gap-6">
                                 <div class="col-span-6 sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">Имя</label>
                                    <input id="first_name" type="text" maxlength="18" minlength="3" required v-model="first_name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                 </div>

                                 <div class="col-span-6 sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">Фамилия</label>
                                    <input id="last_name" type="text" v-model="last_name" maxlength="18" minlength="3" required class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                 </div>

                                 <div class="col-span-6 sm:col-span-4">
                                    <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">Телефон</label>
                                    <input id="phone" type="tel" v-model="delivery.phone" maxlength="13" minlength="7" required class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                 </div>

                                 <div class="col-span-6 sm:col-span-3">
                                    <label for="street_address" class="block text-sm font-medium leading-5 text-gray-700">Адрес доставки</label>
                                    <input id="street_address" type="text" maxlength="50" v-model="delivery.address" required class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                 </div>

                                 <div class="col-span-6">
                                    <label for="orders" class="block mb-1 text-sm font-medium leading-5 text-gray-700">Ваши товары</label>
                                    <v-select @input="selectOrders" :options="orders" label="track_code" multiple/>
                                 </div>

                                 <div class="col-span-6">
                                    <label for="description" class="block text-sm font-medium leading-5 text-gray-700">Описание</label>
                                    <textarea id="description" maxlength="255" v-model="delivery.description" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" > </textarea>
                                 </div>
                              </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                           <button type="submit" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out">
                              Отправить
                           </button>
                        </div>
                     </div>
                  </form>
            </div>
         </div>
      </div>
      <ModalsSuccess />
   </div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
   components: {
      vSelect
   },
   data() {
      return {
         first_name: '',
         last_name: '',
         orders: [],
         delivery: {
            name: '',
            phone: '',
            orders: [],
            address: '',
            description: ''
         }
      }
   },
   mounted() {
      this.init()
   },
   methods: {
      async init() {
         await this.$axios.$get('/profile/get-orders').then((result) => {
               this.orders = result.orders.filter(el => el.status_id == 4)
         }).catch((err) => {
               console.log(err)
         });
      },
      async createDelivery() {
         await this.$axios.$post('/profile/delivery-orders', this.delivery).then((result) => {
            this.$nuxt.$emit('openSuccessModal', {open: true, message: result.message})
            setTimeout(() => {
               this.$router.push('/')
            }, 1250);
         }).catch((err) => {
            console.log(err)
         });
      },    
      selectOrders (data) {
         this.delivery.orders = data.map(o => o.id)
      }
   },
   watch: {
      first_name(val) {
         this.delivery.name = val + ' ' + this.last_name
      },
      last_name(val) {
         this.delivery.name = this.first_name + ' ' + val
      }
   },
   middleware: ['auth']

}
</script>