<template>
  <div class="px-6">
    <div class="w-full py-8">
      <div class="flex items-center justify-between w-full">
        <div>
          <h2 class="md:text-4xl text-2xl font-bold text-gray-700 mb-2.5">Приход</h2>
          <span class="text-gray-800">Раздел кассы, приход суммы.</span>
        </div>
        <div class="flex space-x-3">
          <label for="report-day" class="bg-blue-400 font-medium text-white rounded-md px-3 py-2.5 cursor-pointer" :class="{'bg-blue-700': type_report_date == 1}">
            <input type="radio" id="report-day" class="hidden" v-model="type_report_date" value="1">
            Ежедневный отчет
          </label>
          <label for="report-month" class="bg-blue-400 font-medium text-white rounded-md px-3 py-2.5 cursor-pointer" :class="{'bg-blue-700': type_report_date == 0}">
            <input type="radio" id="report-month" class="hidden" v-model="type_report_date" value="0">
            Ежемесячный отчет
          </label>
        </div>
      </div>
    </div>
    <TablesCashbox :orders="reports" :loading="loading" :type_report="type_report" :type_report_date="type_report_date"/>
  </div>
</template>

<script>

export default {
  data() {
    return {
      reports: [],
      loading: true,
      type_report: 1,
      type_report_date: 1,

    }
  },
  mounted(){
    this.init()
  },
  methods: {
    init() {
      if(this.type_report_date == 0) {
        this.$axios.get('/dashboard/report-monthly')
        .then(res=> {
          this.reports = res.data.reports
          this.loading = false
        })
      } else {
        this.$axios.get('/dashboard/report-daily')
        .then(res=> {
          this.reports = res.data.reports
          this.loading = false
        })
      }
    },
  },
  watch: {
    type_report_date() {
      this.loading = true
      this.init()
    }
  }
}
</script>