<template>
  <div class="max-w-4xl mx-auto px-4 py-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Discover</h1>
      <p class="text-gray-600">Find your perfect match</p>
    </div>

    <!-- Swipe Interface Placeholder -->
    <div class="max-w-sm mx-auto">
      <BaseCard class="text-center" padding="lg">
        <div class="w-32 h-32 bg-gradient-to-r from-primary-100 to-primary-200 rounded-full mx-auto mb-4 flex items-center justify-center">
          <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Swipe Interface</h3>
        <p class="text-gray-600 mb-6">
          The swipe-based matching interface will be implemented here
        </p>
        <div class="flex justify-center space-x-4">
          <BaseButton variant="outline" size="lg">
            ❌ Pass
          </BaseButton>
          <BaseButton variant="primary" size="lg">
            💕 Like
          </BaseButton>
        </div>
      </BaseCard>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '../components/ui/BaseCard.vue'
import BaseButton from '../components/ui/BaseButton.vue'
</script>