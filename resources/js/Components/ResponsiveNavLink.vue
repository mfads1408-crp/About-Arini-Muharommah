<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-pink-400 dark:border-pink-500 text-start text-base font-medium text-pink-700 dark:text-pink-300 bg-pink-50 dark:bg-night-800/80 focus:outline-none focus:text-pink-800 dark:focus:text-pink-200 focus:bg-pink-100 dark:focus:bg-night-700 focus:border-pink-700 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-night-800 hover:border-gray-300 dark:hover:border-night-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-night-800 focus:border-gray-300 dark:focus:border-night-600 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
