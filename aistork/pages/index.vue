<template>
  <div class="relative bg-white overflow-hidden">
    <div class="hidden lg:block lg:absolute lg:inset-0">
      <svg class="absolute top-0 left-1/2 transform translate-x-64 -translate-y-8" width="640" height="784" fill="none" viewBox="0 0 640 784">
        <defs>
          <pattern id="svg-pattern-squares-desktop" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
          </pattern>
        </defs>
        <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
        <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-desktop)" />
      </svg>
    </div>
    <div class="relative pb-16 md:pb-20 lg:pb-24 xl:pb-32">
      <div class="mt-8 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-20 xl:mt-24">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
          <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
            <div class="text-sm font-semibold uppercase tracking-wide text-gray-500 sm:text-base lg:text-sm xl:text-base">
              
            </div>
            <h2 class="mt-1 text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:leading-none sm:text-6xl lg:text-5xl xl:text-6xl">
              Служба доставки
              <br class="hidden md:inline" />
              <span class="text-primary-600">нового формата</span>
            </h2>
            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
              Наша система позволяет вам, отслеживать ваши товары где бы вы не были по трек коду товара.
            </p>
            <div class="mt-5 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
              <p class="text-base font-medium text-gray-900">
                Введите трек код для отслеживания
              </p>
              <form @submit.prevent="findOrder" method="POST" class="mt-3 sm:flex">
                <input type="text" v-model="track_code" class="appearance-none block w-full px-3 py-3 border border-gray-300 text-base leading-6 rounded-md placeholder-gray-500 shadow-sm focus:outline-none focus:placeholder-gray-400 focus:shadow-outline focus:border-blue-300 transition duration-150 ease-in-out sm:flex-1" :class="{'border-red-600 text-red-600':error_message}" placeholder="Ваш трек код" />
                
                <button type="submit" class="mt-3 w-full px-6 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-800 shadow-sm hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900 transition duration-150 ease-in-out sm:mt-0 sm:ml-3 sm:flex-shrink-0 sm:inline-flex sm:items-center sm:w-auto">
                  Сканировать
                </button>

              </form>
              <div class="h-5 py-1">
                <small class="text-sm text-red-600 block w-full" v-if="error_message">Извините по вашему трек коду ничего не найдено !</small>
              </div>
              <p class="mt-3 text-sm leading-5 text-gray-500">
                  Мы заботимся о защите ваших данных. <br/> Ознакомьтесь с
                <nuxt-link to="/privacy-policy" class="font-medium text-gray-900 underline">Политикой конфиденциальности</nuxt-link>.
              </p>
            </div>
          </div>
          <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
            <svg class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-8 scale-75 origin-top sm:scale-100 lg:hidden" width="640" height="784" fill="none" viewBox="0 0 640 784">
              <defs>
                <pattern id="svg-pattern-squares-mobile" x="118" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                  <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
              </defs>
              <rect y="72" width="640" height="640" class="text-gray-50" fill="currentColor" />
              <rect x="118" width="404" height="784" fill="url(#svg-pattern-squares-mobile)" />
            </svg>
            <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
              <button class="relative block w-full rounded-lg overflow-hidden focus:outline-none focus:shadow-outline" @click="isModal = true">
                <img class="w-full" src="https://images.unsplash.com/photo-1556740758-90de374c12ad?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Woman making a sale" />
                <div class="absolute inset-0 w-full h-full flex items-center justify-center">
                  <svg class="h-20 w-20 text-indigo-500" fill="currentColor" viewBox="0 0 84 84">
                    <circle opacity="0.9" cx="42" cy="42" r="42" fill="white" />
                    <path d="M55.5039 40.3359L37.1094 28.0729C35.7803 27.1869 34 28.1396 34 29.737V54.263C34 55.8604 35.7803 56.8131 37.1094 55.9271L55.5038 43.6641C56.6913 42.8725 56.6913 41.1275 55.5039 40.3359Z" />
                  </svg>
                </div>
              </button>
            </div>
          </div>
          <div class="modal" v-if="isModal">
            <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
              <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                  From: "opacity-0"
                  To: "opacity-100"
                Leaving: "ease-in duration-200"
                  From: "opacity-100"
                  To: "opacity-0"
              -->
                <div class="fixed top-2 right-2 p-1 z-50" @click="isModal = false">
                  <button class="h-14 w-14 rounded-full flex items-center justify-center focus:outline-none focus:bg-gray-600">
                    <svg stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 text-white">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg> 
                    <span class="sr-only">Close sidebar</span></button>
                </div>
              
              <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
              </div>

              <!--
                Modal panel, show/hide based on modal state.

                Entering: "ease-out duration-300"
                  From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                  To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                  From: "opacity-100 translate-y-0 sm:scale-100"
                  To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              -->
              <div class="bg-black rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div>
                  <iframe width="100%" height="420" src="https://www.youtube.com/embed/1jfNIBtfWDY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      track_code: '',
      error_message: false,
      isModal: false,
    }
  },
  methods: {
    async findOrder() {
      if(this.$auth.loggedIn) {
        try {
          await this.$axios.$get('/profile/find-order?track_code='+this.track_code).then((result) => {
            result.orders.length > 0 ? this.$router.push(`/profile/orders/${this.track_code}`) : this.error_message = true

          })
        } catch (error) {
          console.log(error)
        }
      } else {
        this.$router.push('/auth/login')
      }
    }
  },
  watch: {
    track_code() {
      this.error_message = false
    }
  }
}
</script>
