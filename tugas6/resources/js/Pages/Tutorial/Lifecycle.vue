<template>
    <div>
        <h1>Vue Lifecycle Hooks Example</h1>
        <p>Message: {{ message }}</p>
        <button @click="toggleComponent">
            Toggle Child Component
        </button>

        <ChildComponent v-if="showChild" />
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';
import ChildComponent from './ChildComponent2.vue';

export default {
    components: {
        ChildComponent,
    },
    setup() {
        const message = ref('This is a lifecycle example');
        const showChild = ref(true);

        const toggleComponent = () => {
            showChild.value = !showChild.value;
        };

        // Lifecycle hooks for the parent component
        onMounted(() => {
            console.log('Parent component mounted!');
        });

        onUnmounted(() => {
            console.log('Parent component unmounted!');
        });

        return {
            message,
            showChild,
            toggleComponent,
        };
    },
};
</script>