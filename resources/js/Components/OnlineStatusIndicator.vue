<script setup lang="ts">
interface Props {
    isOnline: boolean;
}

const props = defineProps<Props>();
</script>

<template>
  <span
      :class="[
      'inline-block h-3 w-3 rounded-full',
      isOnline ? 'bg-green-500 dark:bg-green-400' : 'bg-red-500 dark:bg-red-400'
    ]"
      :title="isOnline ? 'Online' : 'Offline'"
      :aria-label="isOnline ? 'Online' : 'Offline'"
  ></span>
</template>
