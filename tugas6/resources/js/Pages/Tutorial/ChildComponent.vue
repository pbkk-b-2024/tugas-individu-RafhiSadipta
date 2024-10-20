<template>
    <div class="p-4 border rounded bg-gray-100">
        <h2 class="text-lg font-semibold">Child Component</h2>
        <p>{{ message }}</p>
        <button @click="sendMessageToParent" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">
            Send Message to Parent
        </button>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true,
        },
    },
    emits: ['message-from-child'],
    methods: {
        sendMessageToParent() {
            this.$emit('message-from-child', 'Hello Parent, from Child Component!');
        },
    },
};
</script>

<style scoped>
h2 {
    margin-bottom: 8px;
}
</style>