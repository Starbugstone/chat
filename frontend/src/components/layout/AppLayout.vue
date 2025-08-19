<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <AppHeader />
    
    <!-- Main Content -->
    <main class="flex-1">
      <router-view />
    </main>
    
    <!-- Mobile Navigation -->
    <MobileNavigation v-if="isMobile" />
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import AppHeader from './AppHeader.vue'
import MobileNavigation from './MobileNavigation.vue'

const isMobile = ref(false)

const checkMobile = () => {
  isMobile.value = window.innerWidth < 768
}

onMounted(() => {
  checkMobile()
  window.addEventListener('resize', checkMobile)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkMobile)
})
</script>