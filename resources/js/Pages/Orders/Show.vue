<template>
    <div
        class="flex flex-col items-center gap-4 max-w-prose m-auto border-y-2 sm:border-x-2 sm:rounded border-gray-200 p-4"
    >
        <h1 class="text-2xl">Pedido</h1>

        <div class="flex flex-col sm:grid sm:grid-rows-2 sm:grid-cols-2 gap-4">
            <div class="flex flex-col items-center gap-4">
                <h2 class="text-gray-500">Detalles del pedido</h2>
                <OrderDetails :order="order" />
            </div>

            <div class="flex flex-col items-center gap-4 row-[1/-1]">
                <h2 class="text-gray-500">Resumen del pedido</h2>
                <Summary :products="products_summary" />
            </div>
        </div>
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
import OrderDetails from "@/Components/Order/Details.vue";
import Summary from "@/Components/Order/Summary.vue";
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
