<template>
    <div>
        <h1>Vue Directive Tutorial</h1>
        <p v-if="visible">This text is shown because the 'visible' variable is true.</p>
        <button @click="toggleVisibility">
            Toggle Visibility
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: true,
        };
    },
    methods: {
        toggleVisibility() {
            this.visible = !this.visible;
        },
    },
};
</script>