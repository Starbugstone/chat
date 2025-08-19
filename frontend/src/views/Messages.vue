<template>
  <div class="max-w-4xl mx-auto px-4 py-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Messages</h1>
      <p class="text-gray-600">Chat with your matches</p>
    </div>

    <!-- Conversations List -->
    <div class="space-y-4">
      <BaseCard 
        v-for="i in 5" 
        :key="i" 
        class="flex items-center space-x-4 cursor-pointer" 
        hover
        padding="normal"
      >
        <div class="w-12 h-12 bg-gradient-to-r from-primary-100 to-primary-200 rounded-full flex items-center justify-center flex-shrink-0">
          <span class="text-primary-600 font-semibold">{{ String.fromCharCode(65 + i) }}</span>
        </div>
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between mb-1">
            <h3 class="font-medium text-gray-900 truncate">Match {{ i }}</h3>
            <span class="text-sm text-gray-500">2h ago</span>
          </div>
          <p class="text-sm text-gray-600 truncate">
            Hey! How's your day going? Would love to chat more...
          </p>
        </div>
        <div class="flex items-center space-x-2">
          <span class="w-3 h-3 bg-primary-500 rounded-full"></span>
        </div>
      </BaseCard>
    </div>

    <!-- Empty State -->
    <div v-if="false" class="text-center py-12">
      <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No conversations yet</h3>
      <p class="text-gray-600 mb-4">Start matching to begin conversations!</p>
      <BaseButton @click="$router.push('/discover')">
        Find Matches
      </BaseButton>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '../components/ui/BaseCard.vue'
import BaseButton from '../components/ui/BaseButton.vue'
</script>