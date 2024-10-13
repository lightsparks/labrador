<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}>();

// Function to decode HTML entities if needed
const decodeHtml = (html: string) => {
    const txt = document.createElement('textarea');
    txt.innerHTML = html;
    return txt.value;
};
</script>

<template>
    <div>
        <div class="-mb-1 flex flex-wrap">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 text-gray-400"
                    v-text="decodeHtml(link.label)"
                />
                <Link
                    v-else
                    class="mb-1 mr-1 rounded border px-4 py-3 text-sm leading-4 hover:bg-gray-400 focus:border-gray-500 focus:bg-gray-400 focus:text-indigo-950 dark:text-gray-400"
                    :class="{ 'bg-white text-gray-600 font-bold border-gray-400': link.active, 'text-gray-600': !link.active }"
                    :href="link.url"
                >
                    {{ decodeHtml(link.label) }}
                </Link>
            </template>
        </div>
    </div>
</template>

