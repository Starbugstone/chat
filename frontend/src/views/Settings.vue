<template>
  <div class="max-w-2xl mx-auto px-4 py-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Settings</h1>
      <p class="text-gray-600">Manage your account and preferences</p>
    </div>

    <div class="space-y-6">
      <!-- Account Settings -->
      <BaseCard title="Account Settings">
        <div class="space-y-4">
          <div class="flex items-center justify-between py-3 border-b border-gray-200">
            <div>
              <h3 class="font-medium text-gray-900">Email Notifications</h3>
              <p class="text-sm text-gray-600">Receive notifications about matches and messages</p>
            </div>
            <input type="checkbox" checked class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
          </div>

          <div class="flex items-center justify-between py-3 border-b border-gray-200">
            <div>
              <h3 class="font-medium text-gray-900">Push Notifications</h3>
              <p class="text-sm text-gray-600">Get notified on your device</p>
            </div>
            <input type="checkbox" checked class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
          </div>

          <div class="flex items-center justify-between py-3">
            <div>
              <h3 class="font-medium text-gray-900">Show Online Status</h3>
              <p class="text-sm text-gray-600">Let others see when you're online</p>
            </div>
            <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
          </div>
        </div>
      </BaseCard>

      <!-- Privacy Settings -->
      <BaseCard title="Privacy & Safety">
        <div class="space-y-4">
          <div class="flex items-center justify-between py-3 border-b border-gray-200">
            <div>
              <h3 class="font-medium text-gray-900">Discovery</h3>
              <p class="text-sm text-gray-600">Show me in discovery</p>
            </div>
            <input type="checkbox" checked class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
          </div>

          <div class="py-3 border-b border-gray-200">
            <h3 class="font-medium text-gray-900 mb-2">Distance</h3>
            <p class="text-sm text-gray-600 mb-3">Maximum distance for matches</p>
            <input type="range" min="1" max="100" value="25" class="w-full">
            <div class="flex justify-between text-sm text-gray-500 mt-1">
              <span>1 km</span>
              <span>25 km</span>
              <span>100 km</span>
            </div>
          </div>

          <div class="py-3">
            <h3 class="font-medium text-gray-900 mb-2">Age Range</h3>
            <p class="text-sm text-gray-600 mb-3">Preferred age range for matches</p>
            <div class="flex items-center space-x-4">
              <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Min Age</label>
                <input type="number" value="22" min="18" max="100" class="input">
              </div>
              <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Max Age</label>
                <input type="number" value="35" min="18" max="100" class="input">
              </div>
            </div>
          </div>
        </div>
      </BaseCard>

      <!-- Danger Zone -->
      <BaseCard title="Account Management">
        <div class="space-y-4">
          <BaseButton variant="outline" full-width>
            Download My Data
          </BaseButton>
          <BaseButton variant="danger" full-width>
            Delete Account
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