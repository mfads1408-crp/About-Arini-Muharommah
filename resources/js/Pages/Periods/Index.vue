<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    periods: Array,
    nextPeriodDate: String,
});

const form = useForm({
    start_date: new Date().toISOString().substr(0, 10),
    end_date: '',
    flow_intensity: 'Sedang',
    symptoms: '',
    notes: '',
});

const intensities = ['Ringan', 'Sedang', 'Berat', 'Sangat Berat'];

const addPeriod = () => {
    form.post(route('periods.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('start_date', 'end_date', 'symptoms', 'notes');
        },
    });
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};
</script>

<template>
    <Head title="Siklus Menstruasi" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-red-800 font-serif">
                Pelacak Siklus Menstruasi 🩸
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">
                
                <!-- Prediksi Menstruasi Berikutnya -->
                <div v-if="nextPeriodDate" class="bg-gradient-to-r from-red-100 to-pink-100 p-8 rounded-3xl shadow-sm border border-red-200 flex flex-col md:flex-row items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-red-900 mb-1">Prediksi Menstruasi Berikutnya</h3>
                        <p class="text-red-700">Persiapkan dirimu, perkiraan siklus selanjutnya adalah:</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-3xl font-extrabold text-red-600 bg-white px-6 py-3 rounded-2xl shadow-sm border border-red-50">
                        {{ formatDate(nextPeriodDate) }}
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Form Tambah Catatan Siklus -->
                    <div class="w-full md:w-1/3">
                        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-sm border border-red-100 sticky top-6">
                            <h3 class="text-lg font-bold text-red-900 mb-6">Catat Siklus Baru</h3>
                            <form @submit.prevent="addPeriod" class="space-y-4">
                                <div>
                                    <InputLabel value="Tanggal Mulai" class="text-red-700" />
                                    <TextInput
                                        v-model="form.start_date"
                                        type="date"
                                        class="w-full mt-1 border-red-200 focus:border-red-500 focus:ring-red-500"
                                        required
                                    />
                                </div>

                                <div>
                                    <InputLabel value="Tanggal Selesai (Opsional)" class="text-red-700" />
                                    <TextInput
                                        v-model="form.end_date"
                                        type="date"
                                        class="w-full mt-1 border-red-200 focus:border-red-500 focus:ring-red-500"
                                    />
                                </div>

                                <div>
                                    <InputLabel value="Intensitas Aliran" class="text-red-700" />
                                    <select v-model="form.flow_intensity" class="w-full mt-1 border-red-200 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm text-gray-700">
                                        <option v-for="intensity in intensities" :key="intensity" :value="intensity">
                                            {{ intensity }}
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <InputLabel value="Gejala (Symptoms)" class="text-red-700" />
                                    <TextInput
                                        v-model="form.symptoms"
                                        type="text"
                                        class="w-full mt-1 border-red-200 focus:border-red-500 focus:ring-red-500"
                                        placeholder="Kram, sakit kepala, dll"
                                    />
                                </div>
                                
                                <div>
                                    <InputLabel value="Catatan Tambahan" class="text-red-700" />
                                    <textarea
                                        v-model="form.notes"
                                        rows="2"
                                        class="w-full mt-1 border-red-200 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                                        placeholder="..."
                                    ></textarea>
                                </div>

                                <PrimaryButton class="w-full justify-center bg-red-500 hover:bg-red-600 focus:ring-red-500 py-3 rounded-xl mt-4" :disabled="form.processing">
                                    Simpan Catatan
                                </PrimaryButton>
                            </form>
                        </div>
                    </div>

                    <!-- Riwayat Siklus -->
                    <div class="w-full md:w-2/3 space-y-6">
                        <div v-if="periods.length === 0" class="bg-red-50/50 p-10 rounded-3xl border border-dashed border-red-300 text-center text-red-500">
                            <div class="text-5xl mb-4">📅</div>
                            <p>Belum ada catatan menstruasi.</p>
                            <p class="text-sm">Catat siklus pertamamu agar aplikasi dapat mulai memprediksi siklus selanjutnya!</p>
                        </div>

                        <div v-for="period in periods" :key="period.id" class="bg-white p-6 rounded-3xl shadow-sm border border-red-100 relative group overflow-hidden">
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-xl font-bold">
                                        {{ new Date(period.start_date).getDate() }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-red-900">
                                            {{ formatDate(period.start_date) }} 
                                            <span v-if="period.end_date"> - {{ formatDate(period.end_date) }}</span>
                                        </h3>
                                        <p class="text-sm text-red-500 mt-1">
                                            <span class="font-semibold px-2 py-1 bg-red-50 rounded-md mr-2">Aliran: {{ period.flow_intensity }}</span>
                                            <span v-if="period.symptoms" class="text-gray-600 italic">Gejala: {{ period.symptoms }}</span>
                                        </p>
                                    </div>
                                </div>
                                <Link :href="route('periods.destroy', period.id)" method="delete" as="button" class="text-gray-400 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                                    Hapus
                                </Link>
                            </div>
                            <div v-if="period.notes" class="mt-4 pt-4 border-t border-red-50 text-gray-700 text-sm">
                                <strong>Catatan:</strong> {{ period.notes }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
