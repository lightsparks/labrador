<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import {nextTick, ref} from 'vue';
import BackButton from "@/Components/Items/BackButton.vue";
import DeleteButton from "@/Components/Items/DeleteButton.vue";
import EditButton from "@/Components/EditButton.vue";

interface Category {
    id: number;
    name: string;
    description: string;
    online: boolean;
}

interface Props {
    category: Category;
}

const props = defineProps<Props>();

const componentKey = ref(0);

const refreshComponent = async () => {
    componentKey.value++;
    await nextTick();
};

const showDeleteModal = ref(false);

const showEditModal = ref(false);

const form = useForm({
    name: props.category.name,
    description: props.category.description,
    online: props.category.online,
});

const openEditModal = () => {
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
    form.reset();
};

const submitEditForm = () => {
    form.put(route('categories.update', props.category.id), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: async () => {
            closeEditModal();
            await refreshComponent();
        },
    });
};

const openDeleteModal = () => {
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
};

const deleteCategory = () => {
    router.delete(route('categories.destroy', props.category.id), {
        preserveState: false,
        preserveScroll: false,
        onSuccess: () => {
            router.visit(route('categories.index'));
        },
    });
};
</script>

<template>
    <Head :title="category.name" />

    <AuthenticatedLayout  :key="componentKey">
        <template #header>
            <div class="flex items-center justify-start">
                <BackButton :href="route('categories.index')" text="Back to Categories List"/>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="flex justify-between">
                        <div class="px-4 pb-5 sm:px-6">
                            <h3 class="pb-3 text-2xl font-medium leading-6 text-gray-900 dark:text-gray-100">{{ category.name }}</h3>
                            <p class="mt-1 max-w-2xl text-m text-gray-500 dark:text-gray-400">Details and information about {{ category.name }}.</p>
                        </div>
                        <div class="online-status fixed-top">
                            <EditButton class="flex pb-3 justify-end" :onClick="openEditModal"/>
                            <span class="mt-1 pr-3 text-m text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ category.online ? 'Online' : 'Offline' }}</span>
                            <span
                                :class="[
                                    'inline-block h-3 w-3 rounded-full',
                                    category.online ? 'bg-green-500 dark:bg-green-400' : 'bg-red-500 dark:bg-red-400'
                                ]"
                                :title="category.online ? 'Online' : 'Offline'"
                                :aria-label="category.online ? 'Online' : 'Offline'"
                            ></span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <dl class="my-6">
                            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-m font-medium text-gray-500 dark:text-gray-300">ID</dt>
                                <dd class="mt-1 text-m text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ category.id }}</dd>
                            </div>
                            <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-m font-medium text-gray-500 dark:text-gray-300">Name</dt>
                                <dd class="mt-1 text-m text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ category.name }}</dd>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-m font-medium text-gray-500 dark:text-gray-300">Description</dt>
                                <dd class="mt-1 text-m text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ category.description }}</dd>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-m font-medium text-gray-500 dark:text-gray-300">Items Count</dt>
                                <dd class="mt-1 text-m text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">{{ category.items_count }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <DeleteButton :onClick="openDeleteModal" />
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click="closeEditModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800" @click.stop>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Edit Category</h3>
                    <form @submit.prevent="submitEditForm" class="mt-2 text-left">
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
                            <button type="button" @click="closeEditModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                            <button type="submit" class="bg-indigo-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click="closeDeleteModal">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800" @click.stop>
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Are you sure you want to delete this category?</h3>
                    <div class="flex items-center justify-end mt-4">
                        <button @click="closeDeleteModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="deleteCategory" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
