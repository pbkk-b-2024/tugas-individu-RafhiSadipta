<template>
    <div>
        <h1>Vue Reactivity System</h1>
        <input v-model="message" placeholder="Type something" />
        <p>You typed: {{ message }}</p>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    setup() {
        const message = ref('');
        return { message };
    },
};
</script>