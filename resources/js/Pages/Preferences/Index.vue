<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const props = defineProps({
    preferences: Array,
});

const form = useForm({
    category: 'makanan_suka',
    name: '',
});

const categories = {
    'makanan_suka': 'Makanan Kesukaan 🍰',
    'makanan_tidak_suka': 'Makanan Dihindari 🥦',
    'hal_suka': 'Hal yang Disukai 💖',
    'hal_tidak_suka': 'Hal yang Dihindari 🙅‍♀️'
};

const addPreference = () => {
    form.post(route('preferences.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('name'),
    });
};
</script>

<template>
    <Head title="Preferensi & Kesukaan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-purple-800 font-serif">
                Preferensi & Kesukaan ✨
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <!-- Tambah Data Baru -->
                <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-sm border border-purple-100 mb-8">
                    <h3 class="text-lg font-bold text-purple-900 mb-4">Tambah Baru</h3>
                    <form @submit.prevent="addPreference" class="flex flex-col sm:flex-row gap-4 items-end">
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Kategori</label>
                            <select v-model="form.category" class="w-full border-purple-200 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                <option v-for="(label, value) in categories" :key="value" :value="value">
                                    {{ label }}
                                </option>
                            </select>
                        </div>
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-purple-700 mb-1">Nama / Hal</label>
                            <TextInput
                                v-model="form.name"
                                type="text"
                                class="w-full border-purple-200 focus:border-purple-500 focus:ring-purple-500"
                                placeholder="Contoh: Matcha Latte..."
                                required
                            />
                        </div>
                        <PrimaryButton class="bg-purple-600 hover:bg-purple-700 active:bg-purple-800 focus:ring-purple-500 py-3" :disabled="form.processing">
                            Simpan
                        </PrimaryButton>
                    </form>
                </div>

                <!-- Daftar Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div v-for="(label, categoryKey) in categories" :key="categoryKey">
                        <div class="bg-gradient-to-br from-fuchsia-50 to-purple-50 p-6 rounded-2xl shadow-sm border border-purple-100 h-full">
                            <h3 class="text-xl font-bold text-purple-900 mb-4 border-b border-purple-200 pb-2">
                                {{ label }}
                            </h3>
                            
                            <ul class="space-y-3" v-if="preferences.filter(p => p.category === categoryKey).length > 0">
                                <li v-for="pref in preferences.filter(p => p.category === categoryKey)" :key="pref.id" class="flex justify-between items-center bg-white/60 p-3 rounded-xl border border-purple-50">
                                    <span class="text-purple-800 font-medium">{{ pref.name }}</span>
                                    <Link :href="route('preferences.destroy', pref.id)" method="delete" as="button" class="text-rose-400 hover:text-rose-600 text-sm font-semibold transition">
                                        Hapus
                                    </Link>
                                </li>
                            </ul>
                            <div v-else class="text-purple-400 text-sm italic py-4 text-center">
                                Belum ada catatan di kategori ini.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
