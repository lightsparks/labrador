<script setup lang="ts">
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

interface Props {
    showModal: boolean;
    modelType: 'item' | 'category';
    mode: 'create' | 'edit';
    initialData?: any;
    categories?: any[];
}

const props = defineProps<Props>();
const emit = defineEmits(['close', 'submit']);

const form = useForm({
    name: '',
    description: '',
    price: null as number | null,
    stock: null as number | null,
    category_id: null as number | null,
    online: false,
});

watch(() => props.initialData, (newValue) => {
    if (newValue) {
        form.fill(newValue);
    }
}, { immediate: true });

const closeModal = () => {
    emit('close');
    form.reset();
};

const submitForm = () => {
    const route = props.mode === 'create'
        ? `${props.modelType}s.store`
        : `${props.modelType}s.update`;

    const method = props.mode === 'create' ? 'post' : 'put';

    form[method](route(route, props.initialData?.id), {
        preserveScroll: true,
        onSuccess: () => {
            emit('submit');
            closeModal();
        },
    });
};
</script>

<template>
    <!-- ... (keep the existing template code) ... -->
</template>
