<script setup lang="ts">
import Pagination from '@/Components/Pagination.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AddNewButton from "@/Components/AddNewButton.vue";

interface Category {
    id: number;
    name: string;
    description: string;
    online: boolean;
    items_count: number;
}

interface Props {
    categories: {
        data: Category[];
        links: any[];
    };
}

const props = defineProps<Props>();

const showModal = ref(false);
const form = useForm({
    name: '',
    description: '',
    online: false,
});

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
};

const submitForm = () => {
    form.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Categories
                </h2>
                <AddNewButton text="Add new Category" :onClick="openModal" />
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    Items Count
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                            <tr v-for="category in categories.data" :key="category.id" class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800">
                                <Link :href="route('categories.show', category.id)" class="contents">
                                    <td class="whitespace-nowrap px-6 py-4">{{ category.id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ category.name }}</td>
                                    <td class="px-6 py-4">{{ category.description }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center">{{ category.items_count }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                            <span
                                                :class="[
                                                    'inline-block h-3 w-3 rounded-full',
                                                    category.online ? 'bg-green-500 dark:bg-green-400' : 'bg-red-500 dark:bg-red-400'
                                                ]"
                                                :title="category.online ? 'Online' : 'Offline'"
                                                :aria-label="category.online ? 'Online' : 'Offline'"
                                            ></span>
                                    </td>
                                </Link>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination class="mt-6" :links="categories.links" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800" @click.stop>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Add New Category</h3>
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
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.online" class="form-checkbox">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Online</span>
                            </label>
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
