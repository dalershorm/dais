<template>
    <div v-if="open" class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6">
            <div>
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Успешно !
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">
                            {{ message }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
            <span class="flex w-full rounded-md shadow-sm">
                <button @click="open = false;" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Продолжить
                </button>
            </span>
            </div>
        </div>
        </div>

</template>

<script>
export default {
    data() {
        return {
            open: false,
            message: '',
        }
    },
    created() {
        this.$nuxt.$on('openSuccessModal', (data) => {
            this.open = data.open,
            this.message = data.message
        });
    }
}
</script>