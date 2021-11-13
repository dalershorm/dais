<template>
    <div class="h-screen bg-white overflow-hidden flex">
        <ProfileAside />
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <ProfileHeader />
            <Nuxt />
        </div>
    </div>
</template>

<script>
export default {
    middleware: ['auth']
}
</script>

