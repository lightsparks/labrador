<script setup lang="ts">
defineProps<{
    text: string;
    onClick: () => void;
}>();
</script>

<template>
    <button
        @click="onClick"
        class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
    >
        + {{ text }}
    </button>
</template>
