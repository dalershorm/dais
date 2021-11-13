<template>
    <div id="barcode-box" class="shadow overflow-hidden max-w-lg w-full hidden" v-if="box">
        <div class="flex justify-between bg-yellow-400 text-white py-3 px-5 items-center">
            <img src="/img/white-logo.svg" alt="Airstork" width="120px">
        </div>
        <div class="px-4 py-4 flex-grow">
           <div class="flex justify-between mb-5">
                <div>
                    <small class="text-gray-700 font-medium">Код упаковки</small>
                    <h3 class="mt-2">{{ box.name }}</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Место</small>
                    <h3 class="mt-2 text-right">{{ box.orders_count }} (шт)</h3>
                </div>
           </div>
           <div class="flex justify-between">
                <div>
                    <small class="text-gray-700 font-medium">Общий вес </small>
                    <h3 class="mt-2">{{ box.weight }} (кг)</h3>
                </div>
                <div>
                    <small class="text-gray-700 font-medium">Дата упаковки</small>
                    <h3 class="mt-2 capitalize text-right">{{ moment(String(box.created_at)).format('L') }}</h3>
                </div>
           </div>
        </div>
        <div class="py-4 px-3 border-dashed border border-l-3" style="border-color: #E3EBF6;">   
             <barcode :value="box.name" :displayValue="false" :height="50" class="pre-barcode relative w-14" />
        </div>
    </div>
</template>

<style lang="postcss">
    @media print {  
        body * {
            @apply invisible;
        }
        #barcode-box, #barcode-box * {
            @apply visible;
        }
        #barcode-box {
            @apply fixed left-0 top-0;
        }
        #barcode-box {
            @apply flex !important;
        }
        .pre-barcode svg {
            @apply absolute w-max -left-24 top-11 h-10 transform -rotate-90 !important;
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
        props: ['box']   
    }
    
</script>