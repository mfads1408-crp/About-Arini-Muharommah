<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-rose-800 dark:text-rose-300 font-serif">
                Admin Dashboard - Daftar Pengguna
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-night-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-night-700">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-night-600">
                                        <th class="py-3 px-4 font-bold">Nama</th>
                                        <th class="py-3 px-4 font-bold">Email</th>
                                        <th class="py-3 px-4 font-bold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id" class="border-b border-gray-100 dark:border-night-700 hover:bg-gray-50 dark:hover:bg-night-700/50 transition-colors">
                                        <td class="py-3 px-4">{{ user.name }}</td>
                                        <td class="py-3 px-4">{{ user.email }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex gap-4">
                                                <Link :href="route('admin.users.journals', user.id)" class="text-rose-600 dark:text-rose-400 font-medium hover:underline text-sm">
                                                    Lihat Jurnal
                                                </Link>
                                                <Link :href="route('admin.users.periods', user.id)" class="text-rose-600 dark:text-rose-400 font-medium hover:underline text-sm">
                                                    Lihat Siklus
                                                </Link>
                                                <Link :href="route('admin.users.preferences', user.id)" class="text-rose-600 dark:text-rose-400 font-medium hover:underline text-sm">
                                                    Lihat Preferensi
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="users.length === 0">
                                        <td colspan="3" class="py-6 text-center text-gray-500">Belum ada pengguna.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
