<template>
  <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 md:hidden z-50">
    <div class="flex justify-around items-center h-16">
      <router-link 
        to="/discover" 
        class="flex flex-col items-center justify-center flex-1 py-2"
        active-class="text-primary-600"
        inactive-class="text-gray-600"
      >
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="text-xs">Discover</span>
      </router-link>

      <router-link 
        to="/matches" 
        class="flex flex-col items-center justify-center flex-1 py-2"
        active-class="text-primary-600"
        inactive-class="text-gray-600"
      >
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
        </svg>
        <span class="text-xs">Matches</span>
      </router-link>

      <router-link 
        to="/messages" 
        class="flex flex-col items-center justify-center flex-1 py-2 relative"
        active-class="text-primary-600"
        inactive-class="text-gray-600"
      >
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <span class="text-xs">Messages</span>
        <!-- Message notification badge -->
        <span class="absolute -top-1 -right-2 w-5 h-5 bg-primary-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
      </router-link>

      <router-link 
        to="/profile" 
        class="flex flex-col items-center justify-center flex-1 py-2"
        active-class="text-primary-600"
        inactive-class="text-gray-600"
      >
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span class="text-xs">Profile</span>
      </router-link>
    </div>
  </nav>
</template>

<script setup>
// Mobile navigation component for bottom tab navigation
</script>