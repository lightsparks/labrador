<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface Props {
    href: string;
    text?: string;
}

const props = withDefaults(defineProps<Props>(), {
    text: 'Back to List'
});
</script>

<template>
    <Link
        :href="href"
        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
    >
        &lt; {{ text }}
    </Link>
</template>
