<template>
  <div class="max-w-4xl mx-auto px-4 py-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Your Matches</h1>
      <p class="text-gray-600">People who liked you back</p>
    </div>

    <!-- Matches Grid Placeholder -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <div v-for="i in 8" :key="i" class="aspect-square">
        <BaseCard class="h-full flex flex-col items-center justify-center text-center" hover padding="sm">
          <div class="w-16 h-16 bg-gradient-to-r from-primary-100 to-primary-200 rounded-full mb-3 flex items-center justify-center">
            <span class="text-primary-600 font-semibold">{{ String.fromCharCode(65 + i) }}</span>
          </div>
          <h3 class="font-medium text-gray-900 mb-1">Match {{ i }}</h3>
          <p class="text-sm text-gray-500">2 km away</p>
        </BaseCard>
      </div>
    </div>

    <!-- Empty State -->
    <div v-if="false" class="text-center py-12">
      <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
        </svg>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No matches yet</h3>
      <p class="text-gray-600 mb-4">Keep swiping to find your perfect match!</p>
      <BaseButton @click="$router.push('/discover')">
        Start Discovering
      </BaseButton>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '../components/ui/BaseCard.vue'
import BaseButton from '../components/ui/BaseButton.vue'
</script>