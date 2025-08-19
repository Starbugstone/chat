<template>
  <div class="min-h-screen bg-gradient-to-br from-primary-50 to-secondary-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <div class="w-16 h-16 bg-gradient-to-r from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <span class="text-white font-bold text-2xl">💕</span>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">Create your account</h2>
        <p class="mt-2 text-gray-600">Join thousands looking for connections</p>
      </div>

      <BaseCard>
        <form @submit.prevent="handleRegister" class="space-y-6">
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
            placeholder="Create a password"
            required
            :error="errors.password"
            help="Must be at least 8 characters"
          />

          <BaseInput
            v-model="form.confirmPassword"
            type="password"
            label="Confirm Password"
            placeholder="Confirm your password"
            required
            :error="errors.confirmPassword"
          />

          <div class="space-y-4">
            <label class="flex items-start">
              <input 
                v-model="form.ageConfirm"
                type="checkbox" 
                class="mt-1 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                required
              >
              <span class="ml-2 text-sm text-gray-600">
                I confirm that I am 18 years of age or older
              </span>
            </label>

            <label class="flex items-start">
              <input 
                v-model="form.termsAccept"
                type="checkbox" 
                class="mt-1 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
                required
              >
              <span class="ml-2 text-sm text-gray-600">
                I agree to the 
                <a href="#" class="text-primary-600 hover:text-primary-500">Terms of Service</a>
                and 
                <a href="#" class="text-primary-600 hover:text-primary-500">Privacy Policy</a>
              </span>
            </label>
          </div>

          <BaseButton 
            type="submit" 
            :loading="loading" 
            full-width
            size="lg"
          >
            Create Account
          </BaseButton>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Already have an account?
            <router-link to="/login" class="text-primary-600 hover:text-primary-500 font-medium">
              Sign in
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
  password: '',
  confirmPassword: '',
  ageConfirm: false,
  termsAccept: false
})

const errors = ref({})
const loading = ref(false)

const handleRegister = async () => {
  loading.value = true
  errors.value = {}
  
  // Validation
  if (form.value.password !== form.value.confirmPassword) {
    errors.value.confirmPassword = 'Passwords do not match'
    loading.value = false
    return
  }
  
  try {
    // TODO: Implement actual registration logic
    console.log('Registration attempt:', form.value)
    
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1000))
    
    // Redirect to login or email verification
    router.push('/login')
  } catch (error) {
    errors.value = { email: 'Registration failed' }
  } finally {
    loading.value = false
  }
}
</script>