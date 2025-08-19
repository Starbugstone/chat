<template>
  <div id="app">
    <!-- Use layout for authenticated routes -->
    <AppLayout v-if="shouldUseLayout">
      <router-view />
    </AppLayout>
    
    <!-- No layout for auth pages -->
    <router-view v-else />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import AppLayout from './components/layout/AppLayout.vue'

const route = useRoute()

// Routes that don't need the main layout (auth pages, landing page)
const noLayoutRoutes = ['Home', 'Login', 'Register']

const shouldUseLayout = computed(() => {
  return !noLayoutRoutes.includes(route.name)
})
</script>