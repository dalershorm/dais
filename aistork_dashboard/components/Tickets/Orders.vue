<template>
    <div id="barcode" class="shadow overflow-hidden hidden max-w-md w-full" v-if="order">
        <div class="flex justify-between bg-yellow-400 text-white py-5 px-5 items-center">
            <img src="/img/white-logo.svg" alt="Airstork" width="120px">
            <h3 class="mb-0">{{ order.user.client_code }}</h3>
        </div>
        <div class="px-5 pt-5 pb-8 border-dashed border border-b-4" style="border-color: #E3EBF6;">
            <div class="flex justify-between space-x-5">
                <div>
                    <small class="text-gray-700 font-medium">Трек код:</small>
                    <h3 class="mt-2">{{ order.track_code }}</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Доставка в Китае:</small>
                    <h3 class="mt-2 text-right">{{ order.cost_china }} CNY</h3>
                </div>
            </div>
            <div class="flex mt-4 justify-between space-x-5">
                <div>
                    <small class="text-gray-700 font-medium">Место:</small>
                    <h3 class="mt-2">{{ order.boxes }} (шт)</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Вес: </small>
                    <h3 class="mt-2">{{ order.weight }} (кг)</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Доставка:</small>
                    <h3 class="mt-2 text-right">{{ order.cost }} CNY</h3>
                </div>
            </div>
        </div>
        <div class="pt-4 px-5">
            <div class="flex justify-between space-x-5">
                <div>
                    <small class="text-gray-700 font-medium">Код клиета:</small>
                    <h3 class="mt-2 capitalize">{{ order.user.client_code }}</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Дата приема:</small>
                    <h3 class="mt-2 capitalize text-right">{{ moment(String(order.created_at)).format('L') }}</h3>
                </div>
            </div>
            <barcode :value="order.track_code" :height="50" class="flex my-5 px-5 justify-center" />
        </div>
    </div>
</template>
s
<style lang="postcss">
    @media print {  
        body * {
            @apply invisible;
        }
        #barcode, #barcode * {
            @apply visible
        }
        #barcode {
            @apply fixed left-0 top-0;
        }
        #barcode {
            @apply block !important;
        }
    }
</style>
<script>
    import VueBarcode from 'vue-barcode';

    import moment from 'moment'
    import 'moment/locale/ru'

    export default {
        components: {
            'barcode': VueBarcode
        },
        data() {
            return {
                moment: moment,
            }
        },
        props: ['order']   
    }
    
</script>