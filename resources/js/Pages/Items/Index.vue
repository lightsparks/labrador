<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import OnlineStatusIndicator from "@/Components/OnlineStatusIndicator.vue";

interface Category {
    id: number;
    name: string;
}

interface Item {
    id: number;
    name: string;
    price: number | null;
    stock: number | null;
    online: boolean;
    images_count: number;
    category: Category | null;
}

interface Props {
    items: {
        data: Item[];
        links: any[];
    };
    categories: Category[];
}

const props = defineProps<Props>();

const showModal = ref(false);
const form = useForm({
    name: '',
    description: '',
    price: null as number | null,
    stock: null as number | null,
    category_id: null as number | null
});

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
};

const submitForm = () => {
    form.post(route('items.store'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Items
                </h2>
                <button @click="openModal" class="bg-indigo-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Add new Item
                </button>
            </div>
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
                                        Price (€ EUR)
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
                                            {{ item.price }}
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
                                        <td class="whitespace-nowrap px-6 py-4 text-center">
                                            <OnlineStatusIndicator :isOnline="item.online" />
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

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800" @click.stop>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Add New Item</h3>
                    <form @submit.prevent="submitForm" class="mt-2 text-left">
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300" id="name" type="text" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="description">
                                Description
                            </label>
                            <textarea v-model="form.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300" id="description"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="category">
                                Category
                            </label>
                            <select v-model="form.category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300" id="category">
                                <option :value="null">No category selected</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="price">
                                Price
                            </label>
                            <input v-model="form.price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300" id="price" type="number" step="0.01">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="stock">
                                Stock
                            </label>
                            <input v-model="form.stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300" id="stock" type="number">
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <button type="button" @click="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                            <button type="submit" class="bg-indigo-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Confirm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
