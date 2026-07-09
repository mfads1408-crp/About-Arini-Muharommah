<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: Object,
});
</script>

<template>
    <Head :title="`Preferensi ${user.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.dashboard')" class="text-rose-600 dark:text-rose-400 hover:underline font-medium">
                    &larr; Kembali
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-rose-800 dark:text-rose-300 font-serif">
                    Preferensi Makanan/Minuman milik: {{ user.name }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div v-if="user.preferences.length === 0" class="bg-white dark:bg-night-800 p-8 rounded-2xl shadow-sm text-center border border-gray-100 dark:border-night-700">
                    <p class="text-gray-500 dark:text-gray-400">Pengguna ini belum menambahkan preferensi satupun.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div v-for="preference in user.preferences" :key="preference.id" class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ preference.item_name }}</h3>
                            <span 
                                class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                                :class="[
                                    preference.preference_type === 'like' 
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' 
                                        : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                                ]"
                            >
                                {{ preference.preference_type === 'like' ? 'Disukai' : 'Tidak Disukai' }}
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <span class="font-medium bg-gray-100 dark:bg-night-700 px-2 py-1 rounded">Kategori:</span>
                            <span class="capitalize">{{ preference.category }}</span>
                        </div>

                        <div v-if="preference.notes" class="mt-4 pt-4 border-t border-gray-100 dark:border-night-700 text-sm text-gray-600 dark:text-gray-300">
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Alasan / Catatan:</span>
                            {{ preference.notes }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
