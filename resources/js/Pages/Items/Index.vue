<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

interface Item {
    id: number;
    name: string;
    price: number;
    stock: number;
    online: boolean;
    images_count: number;
    category: Category;
}

interface Props {
    items: {
        data: Item[];
        links: any[];
    };
}

defineProps<Props>();
</script>

<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table
                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                        >
                            <thead>
                                <tr>
                                    <th
                                        class="w-1/12 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        ID
                                    </th>
                                    <th
                                        class="w-1/3 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Name
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Category
                                    </th>
                                    <th
                                        class="w-1/6 px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Price (EUR)
                                    </th>
                                    <th
                                        class="w-1/12 px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Stock
                                    </th>
                                    <th
                                        class="w-1/12 px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Images
                                    </th>
                                    <th
                                        class="w-1/12 px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"
                                    >
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900"
                            >
                                <tr
                                    v-for="item in items.data"
                                    :key="item.id"
                                    class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800"
                                >
                                    <Link
                                        :href="route('items.show', item.id)"
                                        class="contents"
                                    >
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ item.id }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{ item.name }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4">
                                            {{
                                                item.category?.name ||
                                                'No Category'
                                            }}
                                        </td>

                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-right"
                                        >
                                            €{{ item.price.toFixed(2) }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-center"
                                        >
                                            {{ item.stock }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-center"
                                        >
                                            {{ item.images_count }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-center"
                                        >
                                            <span
                                                :class="[
                                                    'inline-block h-3 w-3 rounded-full',
                                                    item.online
                                                        ? 'bg-green-500 dark:bg-green-400'
                                                        : 'bg-red-500 dark:bg-red-400',
                                                ]"
                                                :title="
                                                    item.online
                                                        ? 'Online'
                                                        : 'Offline'
                                                "
                                                :aria-label="
                                                    item.online
                                                        ? 'Online'
                                                        : 'Offline'
                                                "
                                            ></span>
                                        </td>
                                    </Link>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination class="mt-6" :links="items.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
