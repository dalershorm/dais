<template>
    <div class="px-6" v-if="empty">
        <div class="flex justify-center">
            <div class="flex overflow-x-scroll py-12">
                <div
                    v-for="column in columns"
                    :key="column.title"
                    class="bg-white rounded-lg px-4 py-4 column-width mr-4 h-auto"
                    >
                    <nuxt-link :to="column.page" class="text-gray-700 font-semibold font-sans tracking-wide text-lg mb-4">{{column.title}}</nuxt-link>
                    <!-- Draggable component comes from vuedraggable. It provides drag & drop functionality -->
                    <div>
                        <!-- Each element from here will be draggable and animated. Note :key is very important here to be unique both for draggable and animations to be smooth & consistent. -->
                        <KanbanTaskCard
                        v-for="(task) in column.tasks"
                        :key="task.id"
                        :task="task"
                        class="mt-3"
                        ></KanbanTaskCard>
                        <!-- </transition-group> -->
                    </div>
                </div>
            </div>
        </div>
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
export default {
  data() {
    return {
      empty: false,
      columns: [
        {
          title: "Прием заказа",
          page: "/orders",
          tasks: []
        },
        {
          title: "Упаковка",
          page: "/boxes",
          tasks: []
        },
        {
            title: "Отправка",
            page: "/sends",
            tasks: []
        },
      ]
    };
  },
  mounted() {
    this.init()
  },
  methods: {
     async init() {
       await this.$axios.$get('/dashboard/get-kanban?orders=1&boxes=1&sends=1&page=1').then((result) => {
         this.columns[0].tasks = result.orders.data 
         this.columns[1].tasks = result.boxes.data
         this.columns[2].tasks = result.sends.data
         this.empty = true
       }).catch((err) => {
         
       });
     }
  }
};
</script>

<style scoped>
.column-width {
  min-width: 320px;
  width: 320px;
}
/* Unfortunately @apply cannot be setup in codesandbox, 
but you'd use "@apply border opacity-50 border-blue-500 bg-gray-200" here */
.ghost-card {
  opacity: 0.5;
  background: #F7FAFC;
  border: 1px solid #4299e1;
}
</style>
