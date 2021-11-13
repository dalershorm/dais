<template>
    <div class="h-screen bg-white overflow-hidden flex">
        <div class="" v-if="open">
            <div class="fixed inset-0 z-40 flex">
            <!--
                Off-canvas menu overlay, show/hide based on off-canvas menu state.

                Entering: "transition-opacity ease-linear duration-300"
                From: "opacity-0"
                To: "opacity-100"
                Leaving: "transition-opacity ease-linear duration-300"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0" @click="open = false">
                <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
            </div>
            <!--
                Off-canvas menu, show/hide based on off-canvas menu state.

                Entering: "transition ease-in-out duration-300 transform"
                From: "-translate-x-full"
                To: "translate-x-0"
                Leaving: "transition ease-in-out duration-300 transform"
                From: "translate-x-0"
                To: "-translate-x-full"
            -->
            <div class="relative max-w-xs w-full bg-white pt-5 pb-4 flex-1 flex flex-col">
                <div class="absolute top-0 right-0 -mr-14 p-1">
                    <button class="h-12 w-12 rounded-full flex items-center justify-center focus:outline-none focus:bg-gray-600" @click="open = false">
                        <svg class="h-6 w-6 text-white" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Close sidebar</span>
                    </button>
                </div>
                <div class="flex-shrink-0 px-4 flex items-center">
                    <img class="h-8 w-auto" src="/logo.svg" alt="Easywire">
                </div>
                <div class="mt-5 flex-1 h-0 overflow-y-auto">
                    <nav class="h-full flex flex-col">
                        <div class="space-y-1">
                            <nuxt-link to="/profile" @click.native="open = false" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-base leading-6 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-100">
                                <!-- Heroicon name: home -->
                                <svg class="mr-4 h-6 w-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Главная
                            </nuxt-link>


                            <nuxt-link to="/profile/orders" @click.native="open = false" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600"  class="group py-2 px-4 flex items-center text-base leading-6 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-100">
                                <!-- Heroicon name: document-search -->
                                <svg class="mr-4 h-6 w-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                </svg>
                                Мои заказы
                            </nuxt-link>

                            <nuxt-link to="/profile/deliveries" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                                <!-- Heroicon name: document-search -->
                                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                </svg>
                                Мои доставки
                            </nuxt-link>
                            
                            <nuxt-link to="/profile/settings" @click.native="open = false" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group flex items-center py-2 px-4 text-base leading-6 font-medium focus:outline-none text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:bg-gray-50">
                                <!-- Heroicon name: cog -->
                                <svg class="mr-4 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Настройки
                            </nuxt-link>
                        </div>
                        <div class="mt-auto pt-10 space-y-1">
                            <nuxt-link to="/profile/help" @click.native="open = false" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                                <!-- Heroicon name: question-mark-circle -->
                                <svg class="mr-3 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Помощь
                            </nuxt-link>

                            <button @click="Logout" type="button" class="group  py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                <!-- Heroicon name: cog -->
                                <svg class="mr-3 h-6 w-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Выйти
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="flex-shrink-0 w-14">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="w-64 flex flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <nav class="bg-gray-50 border-r border-gray-200 pt-5 pb-4 flex flex-col flex-grow overflow-y-auto">
                <div class="flex-shrink-0 px-4 flex items-center">
                    <nuxt-link to="/">
                        <img class="h-10 w-auto" src="/logo.svg" alt="Easywire">
                    </nuxt-link>
                </div>
                <div class="flex-grow mt-10 flex flex-col">
                    <div class="flex-1 space-y-1">
                        <nuxt-link to="/profile" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <!-- Heroicon name: home -->
                            <svg class="mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Главная
                        </nuxt-link>


                        <nuxt-link to="/profile/orders" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <!-- Heroicon name: document-search -->
                            <svg class="mr-3 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                            </svg>
                            Мои заказы
                        </nuxt-link>

                        <nuxt-link to="/profile/deliveries" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <!-- Heroicon name: document-search -->
                            <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                            </svg>
                            Мои доставки
                        </nuxt-link>


                        <nuxt-link to="/profile/settings" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group flex items-center px-4 py-2 text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 focus:outline-none focus:bg-gray-100" aria-current="page">
                        <!-- Heroicon name: cog -->
                            <svg class="mr-3 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Настройки
                        </nuxt-link>
                    </div>
                </div>
                <div class="flex-shrink-0 block w-full">
                    <nuxt-link to="/profile/help" exact-active-class="text-primary-600 bg-gray-50 border-l-4 border-primary-600 hover:text-primary-600" class="group py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                        <!-- Heroicon name: question-mark-circle -->
                        <svg class="mr-3 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Помощь
                    </nuxt-link>

                    <button @click="Logout" type="button" class="group rounded-md py-2 px-4 flex items-center text-sm leading-5 font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50">
                        <!-- Heroicon name: cog -->
                        <svg class="mr-3 h-6 w-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Выйти
                    </button>
                </div>
            </nav>
            </div>
        </div>
    </div>
    
</template>


<script>
export default {
    data() {
        return {
            open: false
        }
    },
    methods: {
        async Logout() {
            await this.$auth.logout()
        }
    },
    created() {
        this.$nuxt.$on('openProfileSidebar', (data) => {
            this.open = data
        })
    }
}
</script>
