<template>
    <li
        class="grid grid-cols-5 gap-2 border border-gray-200 rounded p-2 w-full leading-none"
    >
        <span class="col-[1_/_span_4] text-sm">
            {{ product.name }}
        </span>

        <span
            class="border-s border-gray-300 font-mono font-bold text-end text-sm"
        >
            {{ product.quantity.toLocaleString() }}
        </span>
    </li>
</template>

<script setup>
const { product } = defineProps({
    product: {
        type: Object,
        required: true,
    },
});
</script>
