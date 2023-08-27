<template>
    <div class="w-full">
        <ul class="flex flex-col gap-2">
            <li
                class="grid grid-cols-5 gap-2 border border-gray-200 rounded p-2 w-full leading-none"
                v-for="(product, index) in products"
                :key="index"
            >
                <span class="col-[1_/_span_4] text-sm">
                    {{ product.name }}
                </span>

                <span
                    class="border-s border-gray-300 font-mono font-bold text-end text-sm"
                >
                    {{ product.total_quantity.toLocaleString() }}
                </span>
            </li>
        </ul>
    </div>
</template>

<script setup>
defineProps({
    products: {
        type: Array,
        required: true,
    },
});
</script>
