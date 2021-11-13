<template>
    <div class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
            
            <form @submit.prevent="update">
                <div class="border-b border-gray-200 sm:overflow-hidden pb-4">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h2 class="text-lg leading-6 font-medium text-gray-900">Настройки аккаунта</h2>
                            <p class="mt-1 text-sm leading-5 text-gray-500">Будьте внимательны при изменении данных
                            </p>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3 space-y-1">
                                <label class="block text-sm leading-5 font-medium text-gray-700">
                                    Аватар
                                </label>
                                <div class="flex items-center">
                                    <span class="inline-block bg-gray-100 rounded-full overflow-hidden h-12 w-12">
                                        <img v-if="this.$auth.user.avatar" class="h-full w-full object-cover" :src="$axios.defaults.baseURL.slice(0, -4)+this.$auth.user.avatar" alt="">

                                        <svg v-else class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span>
                                    <span class="ml-5 rounded-md shadow-sm">
                                        <input type="file" class="hidden" id="file" @change="uploadFile($event)">
                                        <label for="file"
                                            class="border border-gray-300 rounded-md py-2 px-3 text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                            Изменить
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">Имя</label>
                                <input :disabled="!profile.edit" id="first_name" type="text" v-model="profile.name" class="disabled:bg-gray-200 form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <label for="client_code" class="block text-sm font-medium leading-5 text-gray-700">Код Клиента</label>
                                <input id="client_code" v-model="profile.client_code" type="text" disabled class="disabled:bg-gray-200 form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <label for="tel" class="block text-sm font-medium leading-5 text-gray-700">Номер телефона</label>
                                <input id="tel" type="tel" v-model="profile.phone" disabled class="disabled:bg-gray-200 form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                           
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <span class="inline-flex rounded-md shadow-sm">
                            <button v-if="profile.edit" type="submit"
                                class="bg-indigo-600 border border-transparent rounded-md py-2 px-4 inline-flex justify-center text-sm leading-5 font-medium text-white hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Сохранить
                            </button>
                            <nav v-else @click="profile.edit = true"
                                class="bg-primary-600 border border-transparent rounded-md py-2 px-4 inline-flex justify-center text-sm leading-5 font-medium text-white hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Изменить
                            </nav>
                           
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
            
            <form @submit.prevent="updatePassword">
                <div class="border-b border-gray-200 sm:overflow-hidden pb-4">
                    <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                        <div>
                            <h2 class="text-lg leading-6 font-medium text-gray-900">Изменить пароль</h2>
                            <p class="mt-1 text-sm leading-5 text-gray-500">Будьте внимательны при изменении данных
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <label for="current_password" class="block text-sm font-medium leading-5 text-gray-700">Старый пароль</label>
                                <div class="relative w-full js-parent">
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                    <input class="hidden js-password-toggle" id="toggle_old" type="checkbox" @change="passwordToggle" />
                                    <label class="px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle_old">
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
                                        <input id="current_password" type="password" v-model="changePass.current_password" required :disabled="!changePass.edit" class="disabled:bg-gray-200 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 js-password" />
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-6 col-span-6 gap-6">
                                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Новый пароль</label>
                                    <div class="relative w-full js-parent">
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                        <input class="hidden js-password-toggle" id="toggle_new" type="checkbox" @change="passwordToggle" />
                                        <label class="px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle_new">
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
                                            <input id="password" type="password" v-model="changePass.password" required :disabled="!changePass.edit" class="disabled:bg-gray-200 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 js-password" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">Подтвердите новый пароль</label>
                                    <div class="relative w-full js-parent">
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                        <input class="hidden js-password-toggle" id="toggle_confirm" type="checkbox" @change="passwordToggle" />
                                        <label class="px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle_confirm">
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
                                            <input id="password_confirmation" type="password" v-model="changePass.password_confirmation" required :disabled="!changePass.edit" class="disabled:bg-gray-200 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 js-password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <span class="inline-flex rounded-md shadow-sm">
                            <button v-if="changePass.edit" type="submit"
                                class="bg-indigo-600 border border-transparent rounded-md py-2 px-4 inline-flex justify-center text-sm leading-5 font-medium text-white hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Сохранить
                            </button>
                            <nav v-else @click="changePass.edit = true"
                                class="bg-primary-600 border border-transparent rounded-md py-2 px-4 inline-flex justify-center text-sm leading-5 font-medium text-white hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Изменить
                            </nav>
                        </span>
                    </div>
                </div>
            </form>
        </div>  
        <ModalsSuccess />
    </div>
    
</template>
<script>
export default {
    layout: 'profile',
    data() {
        return {
            profile: {
                name: this.$auth.user.name,
                client_code: this.$auth.user.client_code,
                phone: this.$auth.user.phone,
                edit: false,
            },
            changePass: {
                current_password: '',
                password: '',
                password_confirmation: '',
                edit: false,
            },
            
        }
    },
    methods: {
        async update() {
            await this.$axios.$post('/profile', {
                name: this.profile.name,
                direction_id: 0,
            }).then((result) => {
                this.profile.edit = false,
                this.$auth.user.name = result.user.name,
                this.$nuxt.$emit('openSuccessModal', {open: true, message: result.message})
                
            }).catch((err) => {
                console.log(err)
            });
        },
        async updatePassword() {
            await this.$axios.$post('/profile/change-password', {
                current_password: this.changePass.current_password,
                password: this.changePass.password,
                password_confirmation: this.changePass.password_confirmation,
            }).then((result) => {
                this.changePass.edit = false,
                this.$nuxt.$emit('openSuccessModal', {open: true, message: result.message})

            }).catch((err) => {
                console.log(err)
            });
        },
        async changeAvatar(url) {
            await this.$axios.$post('/profile/change-avatar', {avatar: url}).then((result) => {
                this.$nuxt.$emit('openSuccessModal', {open: true, message: result.message}),
                this.$auth.user.avatar = url
            }).catch((err) => {
                console.log(err)
            });
        },
        async uploadFile(event) {
            if (event.target.files.length > 0) {
                let form_data = new FormData()
                form_data.append('file', event.target.files[0])
                await this.$axios.$post('/upload-files/avatar', form_data).then((result) => {
                    this.changeAvatar(result.filePath)
                }).catch((err) => {
                    console.log(err)
                });
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