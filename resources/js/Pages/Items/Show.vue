<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

interface Item {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    online: boolean;
    images_count: number;
    category: Category;
}

interface Props {
    item: Item;
}

defineProps<Props>();
</script>

<template>
    <Head :title="item.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ item.name }}
                </h2>
                <Link
                    :href="route('items.index')"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                >
                    Back to List
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Details</h3>
                                <p><strong>Name:</strong> {{ item.name }}</p>
                                <p><strong>Description:</strong> {{ item.description }}</p>
                                <p><strong>Price:</strong> €{{ item.price.toFixed(2) }}</p>
                                <p><strong>Stock:</strong> {{ item.stock }}</p>
                                <p><strong>Status:</strong> {{ item.online ? 'Online' : 'Offline' }}</p>
                                <p><strong>Category:</strong> {{ item.category?.name || 'No Category' }}</p>
                                <p><strong>Images:</strong> {{ item.images_count }}</p>
                            </div>
                            <div>
                                <!-- You can add more sections here, like images or related items -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
