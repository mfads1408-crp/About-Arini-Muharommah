<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-rose-50 text-rose-900 font-sans selection:bg-rose-300 selection:text-white">
        <!-- Navigation -->
        <nav v-if="canLogin" class="absolute top-0 right-0 p-6 flex gap-4 z-10">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-rose-600 hover:text-rose-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-rose-500 transition"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-rose-600 hover:text-rose-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-rose-500 transition"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="font-semibold text-rose-600 hover:text-rose-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-rose-500 transition bg-white px-4 py-2 rounded-full shadow-sm"
                >
                    Register
                </Link>
            </template>
        </nav>

        <!-- Main Content -->
        <main class="flex flex-col items-center justify-center min-h-screen relative overflow-hidden">
            <!-- Decorative Blobs -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>

            <div class="relative z-10 text-center max-w-2xl px-6">
                <div class="text-6xl mb-6">🌸</div>
                <h1 class="text-4xl md:text-5xl font-bold font-serif mb-6 text-rose-800 tracking-tight">
                    About Arini Muharromah
                </h1>
                <p class="text-lg md:text-xl text-rose-700 mb-10 leading-relaxed">
                    Ini adalah Website Pribadi untuk mencatat semua hal tentang Arini Muharromah
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link
                        v-if="!$page.props.auth.user && canRegister"
                        :href="route('register')"
                        class="bg-rose-500 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:bg-rose-600 transition hover:-translate-y-1"
                    >
                        Daftar Akun Baru
                    </Link>
                    <Link
                        v-if="!$page.props.auth.user"
                        :href="route('login')"
                        class="bg-white text-rose-600 font-semibold py-3 px-8 rounded-full shadow-sm hover:shadow-md transition border border-rose-100 hover:-translate-y-1"
                    >
                        Login
                    </Link>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="bg-rose-500 text-white font-semibold py-3 px-8 rounded-full shadow-md hover:bg-rose-600 transition hover:-translate-y-1"
                    >
                        Pergi ke Dashboard
                    </Link>
                </div>
            </div>
        </main>
    </div>
</template>

<style>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
.animation-delay-4000 {
  animation-delay: 4s;
}
</style>
