<template>
    <div class="max-w-screen-xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl leading-9 font-extrabold text-gray-900">Универсальная платформа</h2>
            <p class="mt-4 text-lg leading-7 text-gray-500">Ниже включены услуги которые входят во все тарифы. Мы обеспечиваем гарантию и сахраность вашего товара.</p>
        </div>
        <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-2 sm:col-gap-6 sm:row-gap-12 lg:grid-cols-4 lg:col-gap-8">
            <div class="flex space-x-3" v-for="(info, index) in infos" :key="index">
            <!-- Heroicon name: check -->
                <svg class="flex-shrink-0 h-6 w-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div class="space-y-2">
                    <dt class="text-lg leading-6 font-medium text-gray-900">{{ info.title }}</dt>
                    <dd class="flex space-x-3 lg:py-0 lg:pb-4">
                        <span class="text-base leading-6 text-gray-500">{{ info.short_description }}</span>
                    </dd>
                </div>
            </div>
        </dl>
    </div>
</template>

<script>
export default {
    data() {
        return {
            infos: [
                {
                    title: 'Invite team members',
                    short_description: 'Tempor tellus in aliquet eu et sit nulla tellus. Suspendisse est, molestie blandit quis ac. Lacus.'
                },
                {
                    title: 'Notifications',
                    short_description: 'Ornare donec rhoncus vitae nisl velit, neque, mauris dictum duis. Nibh urna non parturient.'
                },
                {
                    title: 'List view',
                    short_description: 'Etiam cras augue ornare pretium sit malesuada morbi orci, venenatis. Dictum lacus.'
                },
                {
                    title: 'Boards',
                    short_description: 'Interdum quam pulvinar turpis tortor, egestas quis diam amet, natoque. Mauris sagittis.'
                },
                {
                    title: 'Keyboard shortcuts',
                    short_description: 'Ullamcorper in ipsum ac feugiat. Senectus at aliquam vulputate mollis nec. In at risus odio.'   
                },
                {
                    title: 'Reporting',
                    short_description: 'Magna a vel sagittis aliquam eu amet. Et lorem auctor quam nunc odio. Sed bibendum.'
                },
                {
                    title: 'Calendars',
                    short_description: 'Sed mi, dapibus turpis orci posuere integer. A porta viverra posuere adipiscing turpis.'
                },
                { 
                    title: 'Mobile app',
                    short_description: 'Quisque sapien nunc nisl eros. Facilisis sagittis maecenas id dignissim tristique proin sed.'
                }
            ]
        }
    }
}
</script>