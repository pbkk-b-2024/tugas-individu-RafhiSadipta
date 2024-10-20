<template>
    <div>
        <h2>Child Component</h2>
        <p>The child component is active.</p>
    </div>
</template>

<script>
import { onMounted, onBeforeUnmount } from 'vue';

export default {
    setup() {
        onMounted(() => {
            console.log('Child component mounted!');
        });

        onBeforeUnmount(() => {
            console.log('Child component will be unmounted!');
        });

        return {};
    },
};
</script>