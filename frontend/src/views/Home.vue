<template>
  <div class="min-h-screen bg-gradient-to-br from-primary-50 to-secondary-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
          <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
            Find Your Perfect
            <span class="text-gradient">Connection</span>
          </h1>
          <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Join thousands of adults looking for meaningful relationships. 
            Safe, secure, and designed for real connections.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <BaseButton 
              size="lg" 
              @click="$router.push('/register')"
              class="shadow-glow"
            >
              Get Started Free
            </BaseButton>
            <BaseButton 
              variant="outline" 
              size="lg"
              @click="$router.push('/login')"
            >
              Sign In
            </BaseButton>
          </div>
        </div>
      </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Why Choose DateConnect?
          </h2>
          <p class="text-lg text-gray-600">
            Built with privacy, safety, and authentic connections in mind
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <BaseCard class="text-center" hover>
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Safe & Secure</h3>
            <p class="text-gray-600">
              Advanced privacy controls and verification systems to keep you safe
            </p>
          </BaseCard>

          <BaseCard class="text-center" hover>
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Location-Based</h3>
            <p class="text-gray-600">
              Find people near you with smart geolocation matching
            </p>
          </BaseCard>

          <BaseCard class="text-center" hover>
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Real-Time Chat</h3>
            <p class="text-gray-600">
              Instant messaging and communication with your matches
            </p>
          </BaseCard>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import BaseButton from '../components/ui/BaseButton.vue'
import BaseCard from '../components/ui/BaseCard.vue'
</script>