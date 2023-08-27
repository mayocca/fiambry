<template>
    <div
        class="flex flex-col items-center gap-4 max-w-prose m-auto border-y-2 sm:border-x-2 sm:rounded border-gray-200 p-4"
    >
        <h1 class="text-2xl font-medium">Pedido</h1>

        <div
            class="flex flex-col items-center gap-2 border border-gray-200 rounded p-2 w-full max-w-[16rem]"
        >
            <span class="text-gray-500 font-medium">Detalles del pedido</span>
            <span
                v-if="order.details"
                class="text-gray-500 font-light text-sm italic"
                >{{ order.details }}</span
            >
            <div>
                <span class="text-gray-500 font-light text-xs italic"
                    >Creado por {{ order.user.name }}</span
                >
            </div>
        </div>

        <span class="text-gray-500 font-light">Resumen del pedido</span>

        <Summary :products="products_summary" />
    </div>
</template>

<script setup>
defineProps({
    order: {
        type: Object,
        required: true,
    },
    products_summary: {
        type: Object,
        required: true,
    },
});
</script>

<script>
import Summary from "@/Components/Order/Summary.vue";
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
