<template>
    <div class="bg-white rounded border border-gray-200">
      <nuxt-link :to="task.track_code ? '/orders/'+task.id : (task.orders_count) ? '/boxes/'+task.id : '/sends/'+task.id" class="px-3 pt-3 pb-5 block">
        <div class="flex justify-between flex-wrap">
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.user">Код клиента: <span class="text-gray-400">{{task.user.client_code }}</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.track_code">Трек код: <span class="text-gray-400">{{ task.track_code}}</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.name">Название: <span class="text-gray-400">{{ task.name}}</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.weight">Общий вес: <span class="text-gray-400">{{ task.weight}} кг</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.boxes_count">Общий вес: <span class="text-gray-400">{{ require('lodash').sum(task.boxes.weight) }} кг</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.track_code">Место: <span class="text-gray-400">{{ task.boxes }}</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.orders_count">Место: <span class="text-gray-400">{{ task.orders_count }}</span></span>
          <span class="block text-gray-700 font-semibold font-sans tracking-wide text-sm w-10/12" v-if="task.boxes_count">Место: <span class="text-gray-400">{{ task.boxes_count }}</span></span>
          <!-- <span class="h-6 w-6 rounded-full overflow-hidden bg-gray-100"><svg fill="currentColor" viewBox="0 0 24 24" class="h-full w-full text-gray-300"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></span> -->
          <!-- <img
            class="w-6 h-6 rounded-full ml-3"
            src="https://pickaface.net/gallery/avatar/unr_sample_161118_2054_ynlrg.png"
            alt="Avatar"
          > -->
        </div>
        <div class="flex mt-4 justify-between items-center">
          <span class="text-sm text-gray-600">{{ moment(String(task.created_at)).format('MMM D') }}</span>
          <KanbanBadge v-if="task.status" :status_id="task.status_id" :status="task.status">{{task.status.name}}</KanbanBadge>
        </div>
      </nuxt-link>
    </div>
</template>
<script>
import moment from 'moment'
import 'moment/locale/ru'

export default {
  data() {
    return {
      moment: moment
    }
  },
  props: {
    task: {
      type: Object,
      default: () => ({})
    }
  }
};
</script>
