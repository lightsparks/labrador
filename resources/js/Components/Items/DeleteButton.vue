<script setup lang="ts">
import { mdiDelete } from '@mdi/js'

interface Props {
    onClick: () => void;
}

defineProps<Props>();
</script>

<template>
    <button
        @click="onClick"
        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center"
    >
        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
            <path :d="mdiDelete" fill="currentColor" />
        </svg>
        Delete
    </button>
</template>
