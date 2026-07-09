<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const quotes = [
    "You are loved, exactly as you are. 💖",
    "Tarik napas panjang... hari ini adalah hari yang baru. 🌼",
    "Jangan lupa minum air putih dan istirahat ya Arini. 🥤",
    "Setiap hal kecil yang kamu lakukan hari ini sangat berharga. ✨",
    "Pelan-pelan saja, tidak perlu terburu-buru. 🐢"
];
const randomQuote = ref(quotes[Math.floor(Math.random() * quotes.length)]);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h2 class="text-2xl font-bold leading-tight text-rose-800 dark:text-rose-300 font-serif transition-colors">
                    Selamat Datang, {{ $page.props.auth.user.name }} 🌸
                </h2>
                <div class="text-sm text-rose-700 dark:text-rose-200 font-medium bg-rose-100/80 dark:bg-night-800/80 px-4 py-2 rounded-full border border-rose-200 dark:border-night-700 transition-colors">
                    {{ new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">
                
                <!-- Hero Section with Quote -->
                <div class="relative overflow-hidden bg-gradient-to-br from-rose-400 via-pink-400 to-rose-500 dark:from-night-800 dark:via-night-900 dark:to-night-950 rounded-3xl shadow-lg p-8 sm:p-12 text-white transition-colors duration-500 border border-transparent dark:border-night-700">
                    <div class="relative z-10 max-w-2xl">
                        <h3 class="text-3xl sm:text-4xl font-serif font-bold mb-4 leading-tight">Halo Arini, bagaimana harimu?</h3>
                        <p class="text-rose-50 dark:text-gray-300 text-lg mb-8 italic opacity-90">"{{ randomQuote }}"</p>
                        
                        <div class="flex flex-wrap gap-4">
                            <Link :href="route('journals.index')" class="bg-white text-rose-600 dark:bg-night-800 dark:text-rose-300 hover:bg-rose-50 dark:hover:bg-night-700 px-6 py-3 rounded-xl font-bold transition-colors shadow-sm flex items-center gap-2 border border-transparent dark:border-night-600">
                                <span class="text-xl">✍️</span> Tulis Jurnal
                            </Link>
                            <Link :href="route('periods.index')" class="bg-rose-600 text-white dark:bg-indigo-600 hover:bg-rose-700 dark:hover:bg-indigo-700 border border-rose-300/30 dark:border-indigo-400/30 px-6 py-3 rounded-xl font-bold transition-colors shadow-sm flex items-center gap-2">
                                <span class="text-xl">🩸</span> Catat Siklus
                            </Link>
                        </div>
                    </div>
                    
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-white dark:bg-indigo-400 opacity-10 blur-3xl pointer-events-none transition-all duration-500"></div>
                    <div class="absolute bottom-0 right-20 -mb-20 w-64 h-64 rounded-full bg-pink-200 dark:bg-blue-400 opacity-20 blur-2xl pointer-events-none transition-all duration-500"></div>
                    <!-- Stars for Dark Mode -->
                    <div class="hidden dark:block absolute top-10 left-10 w-1 h-1 bg-white rounded-full opacity-50 shadow-[0_0_10px_white]"></div>
                    <div class="hidden dark:block absolute top-20 right-1/3 w-1.5 h-1.5 bg-white rounded-full opacity-70 shadow-[0_0_15px_white]"></div>
                    <div class="hidden dark:block absolute bottom-1/4 left-1/4 w-1 h-1 bg-white rounded-full opacity-40 shadow-[0_0_8px_white]"></div>
                </div>

                <!-- Main Features -->
                <div class="pt-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6 px-2 font-serif transition-colors">Eksplorasi Ruangmu</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Journal Card -->
                        <Link :href="route('journals.index')" class="group relative overflow-hidden bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-pink-50 dark:bg-night-700 rounded-bl-full -mr-10 -mt-10 transition-transform duration-500 group-hover:scale-110"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-100 to-rose-100 dark:from-night-700 dark:to-night-600 rounded-2xl flex items-center justify-center text-2xl mb-4 text-pink-600 dark:text-pink-400 shadow-sm border border-transparent dark:border-night-500">
                                    📖
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">Jurnal Harian</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Lihat semua catatan perasaan dan aktivitasmu sebelumnya.</p>
                            </div>
                        </Link>

                        <!-- Period Tracker Card -->
                        <Link :href="route('periods.index')" class="group relative overflow-hidden bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 dark:bg-night-700 rounded-bl-full -mr-10 -mt-10 transition-transform duration-500 group-hover:scale-110"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 bg-gradient-to-br from-red-100 to-rose-100 dark:from-night-700 dark:to-night-600 rounded-2xl flex items-center justify-center text-2xl mb-4 text-red-600 dark:text-red-400 shadow-sm border border-transparent dark:border-night-500">
                                    🩸
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">Siklus Menstruasi</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Pantau siklus bulanan dan kenali pola tubuhmu dengan lebih baik.</p>
                            </div>
                        </Link>

                        <!-- Preferences Card -->
                        <Link :href="route('preferences.index')" class="group relative overflow-hidden bg-white dark:bg-night-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-night-700 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 dark:bg-night-700 rounded-bl-full -mr-10 -mt-10 transition-transform duration-500 group-hover:scale-110"></div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-fuchsia-100 dark:from-night-700 dark:to-night-600 rounded-2xl flex items-center justify-center text-2xl mb-4 text-purple-600 dark:text-purple-400 shadow-sm border border-transparent dark:border-night-500">
                                    ✨
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Preferensiku</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Kumpulan hal-hal yang kamu suka, makanan favorit, dan lainnya.</p>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
