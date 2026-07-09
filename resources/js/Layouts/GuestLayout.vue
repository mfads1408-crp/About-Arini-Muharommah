<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-rose-50 pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-rose-500" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white/90 backdrop-blur-md px-6 py-4 shadow-xl border border-rose-100 sm:max-w-md sm:rounded-2xl"
        >
            <slot />
        </div>
    </div>
</template>
