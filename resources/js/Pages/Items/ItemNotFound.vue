<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BackButton from "@/Components/Items/BackButton.vue";

const props = defineProps<{ message: string }>();
</script>

<template>
    <Head title="Item Not Found" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Items</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-xl font-semibold mb-4">{{ message }}</h3>
                        <p>It looks like the item you're trying to access doesn't exist or may have been removed.</p>
                        <BackButton :href="route('items.index')" text="Back to Items List"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
