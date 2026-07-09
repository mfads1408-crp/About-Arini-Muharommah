<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: Object,
});
</script>

<template>
    <Head :title="`Siklus ${user.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.dashboard')" class="text-rose-600 dark:text-rose-400 hover:underline font-medium">
                    &larr; Kembali
                </Link>
                <h2 class="text-2xl font-bold leading-tight text-rose-800 dark:text-rose-300 font-serif">
                    Catatan Siklus Menstruasi milik: {{ user.name }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div v-if="user.period_trackers.length === 0" class="bg-white dark:bg-night-800 p-8 rounded-2xl shadow-sm text-center border border-gray-100 dark:border-night-700">
                    <p class="text-gray-500 dark:text-gray-400">Pengguna ini belum mencatat siklus menstruasi satupun.</p>
                </div>

                <div v-for="period in user.period_trackers" :key="period.id" class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700 flex flex-col md:flex-row gap-6">
                    <div class="flex-1 space-y-3">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            Periode: {{ new Date(period.start_date).toLocaleDateString('id-ID') }} 
                            <span v-if="period.end_date"> - {{ new Date(period.end_date).toLocaleDateString('id-ID') }}</span>
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Durasi</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ period.duration_days || '-' }} hari</span>
                            </div>
                            <div>
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Volume Darah</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200 capitalize">{{ period.flow_intensity || '-' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex-1 bg-rose-50 dark:bg-night-700 p-4 rounded-xl">
                        <span class="block text-sm text-rose-600 dark:text-rose-300 mb-2 font-semibold">Gejala yang dirasakan:</span>
                        <div v-if="period.symptoms && period.symptoms.length > 0" class="flex flex-wrap gap-2">
                            <span v-for="(symptom, i) in period.symptoms" :key="i" class="bg-white dark:bg-night-600 text-rose-700 dark:text-rose-200 text-xs px-3 py-1 rounded-full border border-rose-100 dark:border-night-500">
                                {{ symptom }}
                            </span>
                        </div>
                        <span v-else class="text-sm text-gray-500 dark:text-gray-400 italic">Tidak ada gejala yang dicatat.</span>
                        
                        <div v-if="period.notes" class="mt-4 pt-4 border-t border-rose-100 dark:border-night-600 text-sm text-gray-600 dark:text-gray-300">
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Catatan:</span>
                            {{ period.notes }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
