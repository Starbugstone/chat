<template>
  <div :class="cardClasses">
    <!-- Header -->
    <div v-if="$slots.header || title" class="border-b border-gray-200 pb-4 mb-4">
      <slot name="header">
        <h3 v-if="title" class="text-lg font-semibold text-gray-900">
          {{ title }}
        </h3>
      </slot>
    </div>
    
    <!-- Content -->
    <div class="flex-1">
      <slot />
    </div>
    
    <!-- Footer -->
    <div v-if="$slots.footer" class="border-t border-gray-200 pt-4 mt-4">
      <slot name="footer" />
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
  padding: {
    type: String,
    default: 'normal',
    validator: value => ['none', 'sm', 'normal', 'lg'].includes(value)
  },
  shadow: {
    type: String,
    default: 'sm',
    validator: value => ['none', 'sm', 'md', 'lg'].includes(value)
  },
  hover: {
    type: Boolean,
    default: false
  }
})

const cardClasses = computed(() => {
  const baseClasses = 'bg-white rounded-xl border border-gray-200'
  
  const paddingClasses = {
    none: '',
    sm: 'p-4',
    normal: 'p-6',
    lg: 'p-8'
  }
  
  const shadowClasses = {
    none: '',
    sm: 'shadow-sm',
    md: 'shadow-md',
    lg: 'shadow-lg'
  }
  
  const hoverClasses = props.hover ? 'hover:shadow-md transition-shadow duration-200 cursor-pointer' : ''
  
  return [
    baseClasses,
    paddingClasses[props.padding],
    shadowClasses[props.shadow],
    hoverClasses
  ].filter(Boolean).join(' ')
})
</script>