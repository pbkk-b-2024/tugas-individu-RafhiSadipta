<template>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Vue Component Example</h1>
        <p class="mb-4">{{ parentMessage }}</p>

        <ChildComponent message="Hello from Parent!" @message-from-child="handleMessageFromChild" />
    </div>
</template>

<script>
import ChildComponent from './ChildComponent.vue';
import { ref } from 'vue';

export default {
    components: {
        ChildComponent,
    },
    setup() {
        const parentMessage = ref('Waiting for message from child...');

        const handleMessageFromChild = (message) => {
            parentMessage.value = message;
        };

        return {
            parentMessage,
            handleMessageFromChild,
        };
    },
};
</script>

<style scoped>
h1 {
    margin-bottom: 16px;
}
</style>