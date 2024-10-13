<script setup lang="ts">
import NavLink from '@/Components/NavLink.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink>
        <NavLink :href="route('items.index')" :active="route().current('items.index')">
            Items
        </NavLink>
        <NavLink :href="route('categories.index')" :active="route().current('categories.index')">
            Categories
        </NavLink>
        <NavLink :href="route('clients.index')" :active="route().current('clients.index')">
            Clients
        </NavLink>
        <NavLink :href="route('orders.index')" :active="route().current('orders.index')">
            Orders
        </NavLink>
        <NavLink v-if="user.is_admin" :href="route('admin.index')" :active="route().current('admin.index')">
            Admin
        </NavLink>
    </div>
</template>
