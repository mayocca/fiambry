<template>
    <button
        class="relative block px-4 py-2 bg-white text-black shadow-md gradient-border hover:shadow-lg"
    >
        {{ title }}
    </button>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        default: "Button",
    },
});
</script>
