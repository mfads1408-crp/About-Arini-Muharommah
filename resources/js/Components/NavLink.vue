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
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-pink-400 dark:border-pink-500 text-sm font-medium leading-5 text-pink-900 dark:text-pink-300 focus:outline-none focus:border-pink-700 dark:focus:border-pink-400 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-pink-600 dark:hover:text-pink-300 hover:border-pink-300 dark:hover:border-night-600 focus:outline-none focus:text-pink-700 dark:focus:text-pink-300 focus:border-pink-300 dark:focus:border-night-600 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
