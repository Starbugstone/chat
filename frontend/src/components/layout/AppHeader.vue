<template>
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <router-link to="/" class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
              <span class="text-white font-bold text-lg">💕</span>
            </div>
            <span class="text-xl font-bold text-gradient">DateConnect</span>
          </router-link>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <router-link 
            to="/discover" 
            class="text-gray-600 hover:text-primary-600 transition-colors"
            active-class="text-primary-600 font-medium"
          >
            Discover
          </router-link>
          <router-link 
            to="/matches" 
            class="text-gray-600 hover:text-primary-600 transition-colors"
            active-class="text-primary-600 font-medium"
          >
            Matches
          </router-link>
          <router-link 
            to="/messages" 
            class="text-gray-600 hover:text-primary-600 transition-colors"
            active-class="text-primary-600 font-medium"
          >
            Messages
          </router-link>
        </nav>

        <!-- User Menu -->
        <div class="flex items-center space-x-4">
          <!-- Notifications -->
          <button class="relative p-2 text-gray-600 hover:text-primary-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
            </svg>
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-primary-500 rounded-full"></span>
          </button>

          <!-- Profile Menu -->
          <div class="relative">
            <button 
              @click="showProfileMenu = !showProfileMenu"
              class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors"
            >
              <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                <span class="text-primary-600 font-medium text-sm">JD</span>
              </div>
              <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <!-- Profile Dropdown -->
            <div 
              v-if="showProfileMenu"
              class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50"
            >
              <router-link 
                to="/profile" 
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                @click="showProfileMenu = false"
              >
                My Profile
              </router-link>
              <router-link 
                to="/settings" 
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                @click="showProfileMenu = false"
              >
                Settings
              </router-link>
              <hr class="my-1">
              <button 
                @click="logout"
                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
              >
                Sign Out
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const showProfileMenu = ref(false)

const logout = () => {
  // TODO: Implement logout logic
  showProfileMenu.value = false
  router.push('/login')
}
</script>