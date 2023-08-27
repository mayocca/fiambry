<template>
    <button
        class="relative block text-center px-4 py-1 bg-white text-black shadow-md gradient-border hover:shadow-lg"
        @click="$emit('click')"
    >
        <slot />
    </button>
</template>

<script setup>
defineEmits(["click"]);
</script>

<style scoped lang="scss">
$border-radius: 2px;

.gradient-border {
    border-radius: $border-radius;
}
.gradient-border::after {
    $extra: 2px;
    content: "";
    position: absolute;
    inset: -$extra;
    z-index: -1;
    background: linear-gradient(to bottom right, #3b82f6, #f59e0b, #ef4444);
    background-clip: padding-box;
    border-radius: $border-radius + $extra;
}
</style>
