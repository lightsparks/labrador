<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>


<template>
    <Link
        :href="route('register')"
        class="text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
    >
        Register new user
    </Link>
</template>
