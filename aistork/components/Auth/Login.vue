<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <nuxt-link to="/">
                <img class="mx-auto h-12 w-auto" src="/logo.svg" alt="Workflow" />
            </nuxt-link>
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Вход в аккаунт
            </h2>
            <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                Авторизуйтесь чтобы войти в свою аккаунт
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form method="POST" @submit.prevent="Login">
                <div>
                    <label for="tel" class="block text-sm font-medium leading-5 text-gray-700">
                        Номер телефона
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="tel" type="tel" minlength="6" maxlength="9" v-model="phone" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                        Пароль
                    </label>
                    <div class="relative w-full js-parent">
                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                            <input class="hidden js-password-toggle" id="toggle" type="checkbox" @change="passwordToggle" />
                            <label class="px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle">
                                <svg class="h-4 w-4 text-gray-700 block show" fill="none"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                                <svg class="h-4 w-4 text-gray-700 hide hidden" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>
                            </label>
                            </div>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="password" type="password" v-model="password" minlength="6" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 js-password" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out border-gray-300 rounded" />
                            <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                                Запоменить меня
                            </label>
                        </div>

                        <div class="text-sm leading-5">
                            <nuxt-link to="/auth/lost-password" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Забыли пароль?
                            </nuxt-link>
                        </div>
                    </div>

                <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Войти
                    </button>
                </span>
                </div>
            </form>
             <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                У вас
                <nuxt-link to="/auth/register" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    нет аккаунт ?
                </nuxt-link>
            </p>    
            </div>
           
        </div>
       
        </div>
</template>
<script>
export default {
    data() {
        return {
            phone: '',
            password: ''
        }
    },
    methods: {
        async Login() {
            try {
                await this.$auth.loginWith('laravelJWT', {
                    data: {
                        phone: this.phone,
                        password: this.password
                    }
                })
                this.$router.push('/')
            } catch (error) {
                console.log(error)
            }
        },
        passwordToggle(event) {
            let dels = event.target.closest('.js-parent')
            let password = dels.querySelector('.js-password'),
            passwordLabelShow = dels.querySelector('.js-password-label .show'),
            passwordLabelHide = dels.querySelector('.js-password-label .hide')

            if (password.type === 'password') {
                password.type = 'text'
                passwordLabelShow.classList.add('hidden')
                passwordLabelHide.classList.remove("hidden")
            } else {
                password.type = 'password'
                passwordLabelShow.classList.remove('hidden')
                passwordLabelHide.classList.add("hidden")
            }

            password.focus()
        }
    }
}
</script>