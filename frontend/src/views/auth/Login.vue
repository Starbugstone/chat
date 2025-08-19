<template>
  <div class="min-h-screen bg-gradient-to-br from-primary-50 to-secondary-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <div class="w-16 h-16 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <span class="text-white font-bold text-2xl">💕</span>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
        <p class="mt-2 text-gray-600">Sign in to your account</p>
      </div>

      <BaseCard>
        <form @submit.prevent="handleLogin" class="space-y-6">
          <BaseInput
            v-model="form.email"
            type="email"
            label="Email address"
            placeholder="Enter your email"
            required
            :error="errors.email"
          />

          <BaseInput
            v-model="form.password"
            type="password"
            label="Password"
            placeholder="Enter your password"
            required
            :error="errors.password"
          />

          <div class="flex items-center justify-between">
            <label class="flex items-center">
              <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <router-link to="/forgot-password" class="text-sm text-primary-600 hover:text-primary-500">
              Forgot password?
            </router-link>
          </div>

          <BaseButton 
            type="submit" 
            :loading="loading" 
            full-width
            size="lg"
          >
            Sign In
          </BaseButton>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <router-link to="/register" class="text-primary-600 hover:text-primary-500 font-medium">
              Sign up
            </router-link>
          </p>
        </div>
      </BaseCard>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import BaseCard from '../../components/ui/BaseCard.vue'
import BaseInput from '../../components/ui/BaseInput.vue'
import BaseButton from '../../components/ui/BaseButton.vue'

const router = useRouter()

const form = ref({
  email: '',
  password: ''
})

const errors = ref({})
const loading = ref(false)

const handleLogin = async () => {
  loading.value = true
  errors.value = {}
  
  try {
    // TODO: Implement actual login logic
    console.log('Login attempt:', form.value)
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    // Redirect to discover page
    router.push('/discover')
  } catch (error) {
    errors.value = { email: 'Invalid credentials' }
  } finally {
    loading.value = false
  }
}
</script>