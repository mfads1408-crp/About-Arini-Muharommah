<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';

const props = defineProps({
    journals: Array,
});

const form = useForm({
    title: '',
    content: '',
    mood: 'Senang 😊',
    date: new Date().toISOString().substr(0, 10),
});

const moods = [
    'Sangat Bahagia 🌟',
    'Senang 😊',
    'Biasa Saja 😐',
    'Sedih 😢',
    'Lelah 😫',
    'Marah 😠',
    'Cemas 😟'
];

const addJournal = () => {
    form.post(route('journals.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('title', 'content');
        },
    });
};
</script>

<template>
    <Head title="Jurnal Harian" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-rose-800 font-serif">
                Jurnal Harian 📖
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
                
                <!-- Form Tambah Jurnal -->
                <div class="w-full md:w-1/3">
                    <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-sm border border-rose-100 sticky top-6">
                        <h3 class="text-lg font-bold text-rose-900 mb-6">Tulis Cerita Hari Ini</h3>
                        <form @submit.prevent="addJournal" class="space-y-4">
                            <div>
                                <InputLabel value="Tanggal" class="text-rose-700" />
                                <TextInput
                                    v-model="form.date"
                                    type="date"
                                    class="w-full mt-1 border-rose-200 focus:border-rose-500 focus:ring-rose-500"
                                    required
                                />
                            </div>

                            <div>
                                <InputLabel value="Suasana Hati (Mood)" class="text-rose-700" />
                                <select v-model="form.mood" class="w-full mt-1 border-rose-200 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm text-gray-700">
                                    <option v-for="mood in moods" :key="mood" :value="mood">
                                        {{ mood }}
                                    </option>
                                </select>
                            </div>

                            <div>
                                <InputLabel value="Judul" class="text-rose-700" />
                                <TextInput
                                    v-model="form.title"
                                    type="text"
                                    class="w-full mt-1 border-rose-200 focus:border-rose-500 focus:ring-rose-500"
                                    placeholder="Apa yang paling berkesan hari ini?"
                                    required
                                />
                            </div>

                            <div>
                                <InputLabel value="Cerita" class="text-rose-700" />
                                <textarea
                                    v-model="form.content"
                                    rows="5"
                                    class="w-full mt-1 border-rose-200 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm"
                                    placeholder="Tumpahkan semua perasaanmu di sini..."
                                    required
                                ></textarea>
                            </div>

                            <PrimaryButton class="w-full justify-center bg-rose-500 hover:bg-rose-600 py-3 rounded-xl mt-4" :disabled="form.processing">
                                Simpan Jurnal
                            </PrimaryButton>
                        </form>
                    </div>
                </div>

                <!-- Daftar Jurnal -->
                <div class="w-full md:w-2/3 space-y-6">
                    <div v-if="journals.length === 0" class="bg-rose-50/50 p-10 rounded-3xl border border-dashed border-rose-300 text-center text-rose-500 flex flex-col items-center">
                        <div class="text-5xl mb-4">✍️</div>
                        <p>Buku harianmu masih kosong.</p>
                        <p class="text-sm">Ayo mulai tulis jurnal pertamamu di sebelah kiri!</p>
                    </div>

                    <div v-for="journal in journals" :key="journal.id" class="bg-white p-6 rounded-3xl shadow-sm border border-rose-100 hover:shadow-md transition duration-300 relative group overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-pink-100 to-transparent rounded-bl-full opacity-50"></div>
                        
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            <div>
                                <h3 class="text-xl font-bold text-rose-900">{{ journal.title }}</h3>
                                <p class="text-sm text-rose-500 mt-1 font-medium">{{ journal.date }} &nbsp;&bull;&nbsp; {{ journal.mood }}</p>
                            </div>
                            <Link :href="route('journals.destroy', journal.id)" method="delete" as="button" class="text-gray-400 hover:text-red-500 transition opacity-0 group-hover:opacity-100 bg-white rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                        </div>
                        
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap relative z-10">{{ journal.content }}</p>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
