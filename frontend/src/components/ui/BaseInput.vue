<template>
  <div class="space-y-1">
    <label v-if="label" :for="inputId" class="label">
      {{ label }}
      <span v-if="required" class="text-red-500 ml-1">*</span>
    </label>
    
    <div class="relative">
      <input
        :id="inputId"
        :type="type"
        :value="modelValue"
        :placeholder="placeholder"
        :required="required"
        :disabled="disabled"
        :class="inputClasses"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur', $event)"
        @focus="$emit('focus', $event)"
      />
      
      <!-- Icon slot -->
      <div v-if="$slots.icon" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <slot name="icon" />
      </div>
    </div>
    
    <!-- Error message -->
    <p v-if="error" class="text-sm text-red-600">
      {{ error }}
    </p>
    
    <!-- Help text -->
    <p v-else-if="help" class="text-sm text-gray-500">
      {{ help }}
    </p>
  </div>
</template>

<script setup>
import { computed, useId } from 'vue'

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  label: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: ''
  },
  required: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: ''
  },
  help: {
    type: String,
    default: ''
  }
})

defineEmits(['update:modelValue', 'blur', 'focus'])

const inputId = useId()

const inputClasses = computed(() => {
  const baseClasses = 'input'
  const errorClasses = props.error ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : ''
  const disabledClasses = props.disabled ? 'bg-gray-100 cursor-not-allowed' : ''
  
  return [baseClasses, errorClasses, disabledClasses].filter(Boolean).join(' ')
})
</script>