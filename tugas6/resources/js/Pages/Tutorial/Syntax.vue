<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Percobaan Syntax Vue</h1>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="mb-6">
            <button @click="goToDashboard"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">
                Kembali ke Dashboard
            </button>
        </div>

        <!-- Contoh v-if -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Contoh v-if</h2>
            <p v-if="showMessage">Ini pesan yang ditampilkan dengan v-if!</p>
            <button @click="toggleMessage" class="px-4 py-2 bg-blue-500 text-white rounded">
                Toggle Pesan
            </button>
        </div>

        <!-- Contoh Counter -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Contoh Counter</h2>
            <p>Counter: {{ counter }}</p>
            <button @click="increment" class="px-4 py-2 bg-green-500 text-white rounded">
                Tambah
            </button>
            <button @click="decrement" class="ml-2 px-4 py-2 bg-red-500 text-white rounded">
                Kurang
            </button>
        </div>

        <!-- Contoh v-for -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Contoh v-for</h2>
            <ul>
                <li v-for="(item, index) in items" :key="index">
                    {{ item }}
                </li>
            </ul>
        </div>

        <!-- Contoh v-bind -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Contoh v-bind</h2>
            <a :href="dynamicUrl" target="_blank" class="text-blue-500 underline">
                Kunjungi Vue.js
            </a>
            <p :style="{ color: textColor }">
                Ini contoh v-bind untuk mengubah style teks secara dinamis.
            </p>
            <button @click="changeColor" class="mt-2 px-4 py-2 bg-purple-500 text-white rounded">
                Ubah Warna Teks
            </button>
        </div>

        <!-- Contoh v-model -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold">Contoh v-model</h2>
            <input v-model="inputText" placeholder="Ketik sesuatu..." class="border p-2 rounded" />
            <p>Anda mengetik: {{ inputText }}</p>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'; // Import router untuk navigasi

export default {
    setup() {
        const showMessage = ref(true);
        const counter = ref(0);
        const items = ref(['Item 1', 'Item 2', 'Item 3']);

        const toggleMessage = () => {
            showMessage.value = !showMessage.value;
        };

        const increment = () => {
            counter.value++;
        };

        const decrement = () => {
            if (counter.value > 0) {
                counter.value--;
            }
        };

        // Fungsi untuk navigasi ke Dashboard
        const goToDashboard = () => {
            router.visit('/dashboard');
        };

        // v-bind example
        const dynamicUrl = ref('https://vuejs.org');
        const textColor = ref('black');

        const changeColor = () => {
            textColor.value = textColor.value === 'black' ? 'purple' : 'black';
        };

        // v-model example
        const inputText = ref('');

        return {
            showMessage,
            counter,
            items,
            toggleMessage,
            increment,
            decrement,
            goToDashboard,
            dynamicUrl,
            textColor,
            changeColor,
            inputText,
        };
    },
};
</script>

<style scoped>
h1 {
    margin-bottom: 16px;
}
</style>