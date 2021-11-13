<template>
    <header>
        <!--
        Mobile menu, show/hide based on mobile menu state.

        Entering: "duration-200 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
        Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->
        <div v-if="open" class="fixed z-20 top-0 inset-x-0 p-2 transition transform origin-top-right duration-200 ease-out opacity-0 scale-95 bg-gray-50 h-full" :class="{'opacity-100 scale-100': open}">
            <div class="rounded-lg shadow-lg">
                <div class="bg-white rounded-lg shadow-xs divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <img class="h-8 w-auto" src="/logo.svg" alt="Workflow">
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="open = false">
                                <!-- Heroicon name: x -->
                                <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                    <nav class="grid gap-y-8">
                        <nuxt-link to="/services" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150" @click.native="open = false">
                        <!-- Heroicon name: chart-bar -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                Наши Услуги
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/tarifs" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150"  @click.native="open = false">
                        <!-- Heroicon name: cursor-click -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                Тарифы
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/delivery" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150"  @click.native="open = false">
                            <!-- Heroicon name: shield-check -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                Доставка
                            </div>
                        </nuxt-link>
                        <nuxt-link to="/about" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150"  @click.native="open = false">
                            <!-- Heroicon name: view-grid -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                О компании
                            </div>
                        </nuxt-link>
                    </nav>
                    </div>
                </div>
                <hr class="h-1 w-full bg-gray-900 bg-opacity-10">
                <div class="py-6 px-5 space-y-6">
                    <div class="space-y-6" v-if="!this.$auth.loggedIn">
                        <nuxt-link to="/auth/register"  @click.native="open = false" class="w-full whitespace-no-wrap bg-primary-600 bg-opacity-20 border border-transparent rounded-md py-2 px-4 flex items-center justify-center text-base leading-6 font-medium text-primary-600 hover:bg-primary-600 hover:bg-opacity-10 focus:outline-none focus:border-primary-100 focus:shadow-outline-purple active:bg-primary-600 active:bg-opacity-10 transition ease-in-out duration-150">
                            Зарегистрироваться
                        </nuxt-link>
                        <p class="text-center text-base leading-6 font-medium text-gray-500">
                            Уже есть аккаунт ?
                            <nuxt-link to="/auth/login"  @click.native="open = false" class="text-primary-600 hover:text-gray-900 transition ease-in-out duration-150">
                                Войти
                            </nuxt-link>
                        </p>
                    </div>
                    <div class="space-y-6" v-else>
                        <nuxt-link to="/profile" @click.native="open = false" type="button" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150">
                            <!-- Heroicon name: view-grid -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                Профиль
                            </div>
                        </nuxt-link>
                        <button type="button" @click="Logout" class="-m-3 rounded-md p-3 flex items-center space-x-3 hover:bg-gray-50 transition ease-in-out duration-150">
                            <!-- Heroicon name: view-grid -->
                            <svg class="flex-shrink-0 h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <div class="text-base leading-6 font-medium text-gray-900">
                                Выйти
                            </div>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="relative bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex justify-between items-center py-7 md:justify-start md:space-x-10">
                    <div class="lg:w-0 lg:flex-1">
                        <nuxt-link to="/" class="flex">
                            <img class="h-8 w-auto sm:h-10" src="/logo.svg" alt="Workflow">
                        </nuxt-link>
                    </div>
                    <div class="-mr-2 -my-2 md:hidden">
                        <button type="button" class="rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="open = true">
                            <span class="sr-only">Open menu</span>
                            <!-- Heroicon name: menu -->
                            <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                    <nav class="hidden md:flex space-x-10">
                        <nuxt-link to="/services" active-class="text-gray-900 " exact-active-class="border-b-2 border-primary-600" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 py-3">
                            Наши Услуги
                        </nuxt-link>

                        <nuxt-link to="/tarifs" active-class="text-gray-900 " exact-active-class="border-b-2 border-primary-600" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 py-3">
                            Тарифы
                        </nuxt-link>
                        <nuxt-link to="/delivery" active-class="text-gray-900 " exact-active-class="border-b-2 border-primary-600" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 py-3">
                            Доставка
                        </nuxt-link>

                        <nuxt-link to="/about" active-class="text-gray-900 " exact-active-class="border-b-2 border-primary-600"  class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 py-3">
                            О компании
                        </nuxt-link>
                    </nav>
                    <div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0" v-if="!this.$auth.loggedIn">
                        <nuxt-link to="/auth/login" class="whitespace-no-wrap text-base leading-6 font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900 py-3">
                            Войти
                        </nuxt-link>
                        <nuxt-link to="/auth/register" class="whitespace-no-wrap bg-primary-600 bg-opacity-20 border border-transparent rounded-md py-2 px-4 inline-flex items-center justify-center text-base leading-6 font-medium text-primary-600 hover:bg-primary-600 hover:bg-opacity-10 focus:outline-none focus:border-primary-100 focus:shadow-outline-purple active:bg-primary-600 active:bg-opacity-10 transition ease-in-out duration-150">
                            Зарегистрироваться
                        </nuxt-link>
                    </div>
                    <div class="hidden md:flex items-center justify-end space-x-8 md:flex-1 lg:w-0" v-else>
                            <div @click="dropdown = !dropdown"  class="ml-4 relative flex-shrink-0" x-data="{ dropdown: false }">
                                <div>
                                    <button class="flex-shrink-0 group block focus:outline-none">
                                        <div class="flex items-center">
                                            <div class="flex items-center border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                <img v-if="this.$auth.user.avatar" class="inline-block h-9 w-9 rounded-full object-cover" :src="$axios.defaults.baseURL.slice(0, -4)+this.$auth.user.avatar" alt="">
                                                
                                                <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100"  v-else>
                                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">
                                                    {{ this.$auth.user.client_code ? this.$auth.user.client_code : 'A-34112'}}
                                                </p>
                                                <p class="text-xs leading-4 font-medium text-gray-500 group-hover:text-gray-700 group-focus:underline transition ease-in-out duration-150">
                                                    Профиль
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                    <!-- <button @click="dropdown = !dropdown" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                                    </button> -->
                                </div>
                                <div v-if="dropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg transform opacity-0 scale-95 z-10" :class="{'opacity-100 scale-100' : dropdown}">
                                    <div class="py-1 rounded-md bg-white shadow-xs">
                                        <nuxt-link to="/profile" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Профиль</nuxt-link>
                                        <nuxt-link to="/profile/orders" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Мои заказы</nuxt-link>
                                        <button @click="Logout" type="button" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full text-left">Выйти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>  
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            open: false,
            dropdown: false
        }
    },
    methods: {
        Logout() {
            this.$auth.logout(),
            this.open = false
        }
    }

}
</script>
