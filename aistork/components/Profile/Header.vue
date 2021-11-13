<template>
  <!-- Search header -->
  <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:hidden">
    <!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
    <button class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 lg:hidden" aria-label="Open sidebar" @click="openSidebar">
      <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M4 6h16M4 12h8m-8 6h16"></path>
      </svg>
    </button>
    <div class="flex-1 flex justify-between px-4 sm:px-6 lg:px-8">
      <div class="flex-1 flex items-center justify-center">
        <nuxt-link to="/">
          <img src="/logo.svg" class="h-9 w-auto">
        </nuxt-link>
      </div>
      <div class="flex items-center">
        <!-- Profile dropdown -->
        <div class="ml-3 relative">
          <div>
            <nuxt-link to="/profile/settings" type="button" class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline" id="user-menu" aria-label="User menu" aria-haspopup="true" @click="open = !open">
              <img v-if="this.$auth.user.avatar" class="inline-block h-8 w-8 rounded-full" :src="this.$auth.user.avatar" alt="">
                                    
              <span class="inline-block h-9 w-9 rounded-full overflow-hidden bg-gray-100 shadow"  v-else>
                  <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
              </span>
            </nuxt-link>
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
      isAside: false,
      open: false
    }
  },
  methods: {
      async Logout() {
          await this.$auth.logout()
      },
      openSidebar() {
        this.$nuxt.$emit('openProfileSidebar', true)
      }

  }
}
</script>
