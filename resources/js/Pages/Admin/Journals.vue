<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: Object,
});
</script>

<template>
    <Head :title="`Jurnal ${user.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.dashboard')" class="text-rose-600 dark:text-rose-400 hover:underline font-medium">
                    &larr; Kembali
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-rose-800 dark:text-rose-300 font-serif">
                    Jurnal milik: {{ user.name }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div v-if="user.journals.length === 0" class="bg-white dark:bg-night-800 p-8 rounded-2xl shadow-sm text-center border border-gray-100 dark:border-night-700">
                    <p class="text-gray-500 dark:text-gray-400">Pengguna ini belum menulis jurnal satupun.</p>
                </div>

                <div v-for="journal in user.journals" :key="journal.id" class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ journal.title }}</h3>
                        <span class="text-sm text-gray-500 bg-gray-100 dark:bg-night-700 px-3 py-1 rounded-full">
                            {{ new Date(journal.created_at).toLocaleDateString('id-ID') }}
                        </span>
                    </div>
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                        {{ journal.content }}
                    </div>
                    <div v-if="journal.mood" class="mt-4 pt-4 border-t border-gray-100 dark:border-night-700 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-medium">Mood:</span> 
                        <span class="capitalize">{{ journal.mood }}</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
