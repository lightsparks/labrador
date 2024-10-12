<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Item {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    online: boolean;
    images_count: number;
    category: {
        id: number;
        name: string;
    };
}

interface Props {
    item: Item;
}

const props = defineProps<Props>();
const showDeleteModal = ref(false);

const openDeleteModal = () => {
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
};

const deleteItem = () => {
    router.delete(route('items.destroy', props.item.id), {
        preserveState: false,
        preserveScroll: false,
        onSuccess: () => {
            router.visit(route('items.index'));
        },
    });
};
</script>

<template>
    <Head :title="item.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ item.name }}
                </h2>
                <button @click="openDeleteModal" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Delete
                </button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="font-bold">ID:</div>
                            <div>{{ item.id }}</div>

                            <div class="font-bold">Name:</div>
                            <div>{{ item.name }}</div>

                            <div class="font-bold">Description:</div>
                            <div>{{ item.description }}</div>

                            <div class="font-bold">Price:</div>
                            <div>€{{ item.price.toFixed(2) }}</div>

                            <div class="font-bold">Stock:</div>
                            <div>{{ item.stock }}</div>

                            <div class="font-bold">Status:</div>
                            <div>{{ item.online ? 'Online' : 'Offline' }}</div>

                            <div class="font-bold">Images:</div>
                            <div>{{ item.images_count }}</div>

                            <div class="font-bold">Category:</div>
                            <div>{{ item.category.name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click="closeDeleteModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800" @click.stop>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Are you sure you want to delete this item?</h3>
                    <div class="flex items-center justify-end mt-4">
                        <button @click="closeDeleteModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="deleteItem" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
