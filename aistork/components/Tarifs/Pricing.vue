<template>
    <div class="max-w-screen-xl mx-auto pt-24 px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:flex-col sm:align-center">
            <h1 class="text-5xl leading-none font-extrabold text-gray-900 sm:text-center">Тарифный планы</h1>
            <p class="mt-5 text-xl leading-7 text-gray-500 sm:text-center">Ниже вы можете Ознакомьться с нашими тарифными планами. <br /> Выберите подходящий вам тариф для малого или большого груза.</p>
            <div class="relative mt-6 bg-gray-100 rounded-lg p-0.5 flex self-center sm:mt-8">
                <button type="button" class="relative bg-white border-gray-200 rounded-md shadow-sm py-2 w-1/2 text-sm leading-5 font-medium text-gray-700 whitespace-no-wrap hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue focus:z-10 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 sm:w-auto sm:px-8">Малый груз</button>
                <button type="button" class="relative border border-transparent rounded-md py-2 w-1/2 text-sm leading-5 font-medium text-gray-700 whitespace-no-wrap hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue focus:z-10 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 sm:w-auto sm:px-8">Большой груз</button>
            </div>
        </div>
        <div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-4">
            <div class="border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200" v-for="(pricing, index) in pricings" :key="index">
                <div class="p-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">{{ pricing.title }}</h2>
                    <p class="mt-4 text-sm leading-5 text-gray-500">{{ pricing.short_description }}</p>
                    <p class="mt-8">
                    <span class="text-4xl leading-10 font-extrabold text-gray-900">${{ pricing.price }}</span>
                    <span class="text-base leading-6 font-medium text-gray-500">/mo</span>
                    </p>
                    <button type="button" class="mt-8 w-full bg-gray-800 border border-transparent rounded-md py-2 text-sm leading-5 font-semibold text-white hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-purple active:bg-gray-700 transition duration-150 ease-in-out">Подробнее</button>
                </div>
                <div class="pt-6 pb-8 px-6">
                    <h3 class="text-xs leading-4 font-medium text-gray-900 tracking-wide uppercase">Что включено</h3>
                    <ul class="mt-6 space-y-4">
                        <li class="flex space-x-3" v-for="(item, index) in pricing.included" :key="index">
                            <!-- Heroicon name: check -->
                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm leading-5 text-gray-500">{{ item.title }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    data() {
        return {
            pricings: [
                {
                    title: 'Hobby',
                    short_description: 'All the basics for starting a new business',
                    price: '12',
                    included: [
                        {
                            title: 'Potenti felis, in cras at at ligula nunc.'
                        },
                        {
                            title: 'Orci neque eget pellentesque.'
                        }
                    ]
                },
                {
                    title: 'Freelancer',
                    short_description: 'All the basics for starting a new business',
                    price: '24',
                    included: [
                        {
                            title: 'Potenti felis, in cras at at ligula nunc.'
                        },
                        {
                            title: 'Orci neque eget pellentesque.'
                        },
                        {
                            title: 'Donec mauris sit in eu tincidunt etiam.'
                        }
                    ]
                },
                {
                    title: 'Startup',
                    short_description: 'All the basics for starting a new business',
                    price: '32',
                    included: [
                        {
                            title: 'Potenti felis, in cras at at ligula nunc.'
                        },
                        {
                            title: 'Orci neque eget pellentesque.'
                        },
                        {
                            title: 'Donec mauris sit in eu tincidunt etiam.'
                        },
                        {
                            title: 'Faucibus volutpat magna'
                        }
                    ]
                },
                {
                    title: 'Enterprise',
                    short_description: 'All the basics for starting a new business',
                    price: '48',
                    included: [
                        {
                            title: 'Potenti felis, in cras at at ligula nunc.'
                        },
                        {
                            title: 'Orci neque eget pellentesque.'
                        },
                        {
                            title: 'Donec mauris sit in eu tincidunt etiam.'
                        },
                        {
                            title: 'Faucibus volutpat magna'
                        },
                        {
                            title: 'Id sed tellus in varius quisque.'
                        },
                        {
                            title: 'Risus egestas faucibus.'
                        },
                        {
                            title: 'Risus cursus ullamcorper.'
                        },
                    ]
                },
                
            ]
        }
    }
}

</script>