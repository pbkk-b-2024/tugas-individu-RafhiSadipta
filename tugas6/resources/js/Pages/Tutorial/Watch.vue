<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Vue Watcher Example</h1>

        <!-- Input dan Greeting -->
        <div class="mb-4">
            <input v-model="name" placeholder="Enter your name" class="border p-2 rounded w-full max-w-md" />
            <p class="mt-2 text-lg">Greeting: {{ greeting }}</p>
        </div>

        <!-- Tombol Kembali ke Dashboard Menggunakan Inertia Link -->
        <div class="mt-6">
            <Link :href="route('dashboard')"
                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 transition">
            Kembali ke Dashboard
            </Link>
        </div>
    </div>
</template>

<script>
import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3'; // Ganti dengan komponen Link

export default {
    setup() {
        const name = ref('');
        const greeting = ref('Hello!');

        // Watch perubahan nama
        watch(name, (newValue) => {
            greeting.value = `Hello, ${newValue}!`;
        });

        return { name, greeting };
    },
};
</script>

<style scoped>
h1 {
    margin-bottom: 16px;
}

input {
    width: 100%;
    max-width: 300px;
}
</style>