<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import NavLogo from "@/Components/Logo/NavLogo.vue";
</script>

<template>
    <Link :href="route('dashboard')" class="flex align-baseline">
        <div>
            <NavLogo
                class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
            />
        </div>
        <div class="m-auto text-gray-900 dark:text-gray-100 px-6 font-bold scale-150">
            Labrador
        </div>
    </Link>
</template>
