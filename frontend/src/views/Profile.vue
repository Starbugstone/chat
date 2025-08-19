<template>
  <div class="max-w-2xl mx-auto px-4 py-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">My Profile</h1>
      <p class="text-gray-600">Manage your profile and preferences</p>
    </div>

    <!-- Profile Card -->
    <BaseCard class="mb-6">
      <div class="text-center mb-6">
        <div class="w-24 h-24 bg-gradient-to-r from-primary-100 to-primary-200 rounded-full mx-auto mb-4 flex items-center justify-center">
          <span class="text-primary-600 font-bold text-2xl">JD</span>
        </div>
        <h2 class="text-xl font-semibold text-gray-900">John Doe</h2>
        <p class="text-gray-600">25 years old • 2 km away</p>
      </div>

      <div class="space-y-4">
        <div>
          <h3 class="font-medium text-gray-900 mb-2">About Me</h3>
          <p class="text-gray-600">
            Love hiking, good coffee, and meaningful conversations. Looking for someone to explore the city with!
          </p>
        </div>

        <div>
          <h3 class="font-medium text-gray-900 mb-2">Interests</h3>
          <div class="flex flex-wrap gap-2">
            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">Hiking</span>
            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">Coffee</span>
            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">Travel</span>
            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">Photography</span>
          </div>
        </div>
      </div>

      <div class="mt-6 pt-6 border-t border-gray-200">
        <BaseButton full-width>
          Edit Profile
        </BaseButton>
      </div>
    </BaseCard>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 gap-4">
      <BaseCard class="text-center" hover>
        <svg class="w-8 h-8 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <h3 class="font-medium text-gray-900">Settings</h3>
      </BaseCard>

      <BaseCard class="text-center" hover>
        <svg class="w-8 h-8 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="font-medium text-gray-900">Photos</h3>
      </BaseCard>
    </div>
  </div>
</template>

<script setup>
import BaseCard from '../components/ui/BaseCard.vue'
import BaseButton from '../components/ui/BaseButton.vue'
</script>