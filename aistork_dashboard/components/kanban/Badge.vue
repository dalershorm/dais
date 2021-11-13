<template>
  <div class="px-3 h-6 rounded-full text-xs font-semibold flex items-center"
    :class="status_id == 1 ? 'bg-blue-100 text-blue-700' : (status_id == 2 ? 'bg-gray-100 text-gray-700' : (status.id == 3 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700'))">
    <span class="w-2 h-2 rounded-full mr-1" :class="status_id == 1 ? 'bg-blue-400' : (status_id == 2 ? 'bg-gray-400' : (status.id == 3 ? 'bg-yellow-400' : 'bg-green-400'))"></span>
    <span>
      <slot></slot>
    </span>
  </div>
</template>

<script>
export default {
  props: ['status_id', 'status']
}
</script>