<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-rose-800 font-serif">
                Selamat Datang, {{ $page.props.auth.user.name }} 🌸
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Welcome Message -->
                <div class="overflow-hidden bg-white/80 backdrop-blur-md shadow-sm sm:rounded-2xl border border-rose-100 mb-8">
                    <div class="p-8 text-rose-900 text-center">
                        <p class="text-lg mb-2">Ini adalah ruang aman dan pribadimu.</p>
                        <p class="text-rose-600">Catat keseharian, siklus, dan semua hal yang kamu sukai di sini.</p>
                    </div>
                </div>

                <!-- Feature Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Journal Card -->
                    <Link :href="route('journals.index')" class="bg-gradient-to-br from-pink-50 to-rose-100 p-6 rounded-2xl shadow-sm border border-rose-200 hover:shadow-md transition-shadow cursor-pointer flex flex-col items-center text-center hover:-translate-y-1 transform duration-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mb-4">
                            📖
                        </div>
                        <h3 class="text-xl font-bold text-rose-900 mb-2">Jurnal Harian</h3>
                        <p class="text-rose-700 text-sm">Catat perasaan dan aktivitasmu hari ini.</p>
                    </Link>

                    <!-- Period Tracker Card -->
                    <Link :href="route('periods.index')" class="bg-gradient-to-br from-red-50 to-pink-100 p-6 rounded-2xl shadow-sm border border-pink-200 hover:shadow-md transition-shadow cursor-pointer flex flex-col items-center text-center hover:-translate-y-1 transform duration-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mb-4">
                            🩸
                        </div>
                        <h3 class="text-xl font-bold text-rose-900 mb-2">Siklus Menstruasi</h3>
                        <p class="text-rose-700 text-sm">Lacak siklus dan gejala yang kamu rasakan.</p>
                    </Link>

                    <!-- Preferences Card -->
                    <Link :href="route('preferences.index')" class="bg-gradient-to-br from-fuchsia-50 to-purple-100 p-6 rounded-2xl shadow-sm border border-purple-200 hover:shadow-md transition-shadow cursor-pointer flex flex-col items-center text-center hover:-translate-y-1 transform duration-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-3xl shadow-sm mb-4">
                            ✨
                        </div>
                        <h3 class="text-xl font-bold text-purple-900 mb-2">Preferensi</h3>
                        <p class="text-purple-700 text-sm">Daftar makanan kesukaan, ketidaksukaan, dan hal-hal favorit lainnya.</p>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
