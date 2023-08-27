<template>
    <div
        class="flex flex-col items-center gap-4 max-w-prose m-auto border-y-2 sm:border-x-2 sm:rounded border-gray-200 p-4"
    >
        <h1 class="text-2xl">Pedido</h1>

        <div class="flex flex-col items-center gap-4 w-full row-[1/-1]">
            <h2 class="text-gray-500">Mis productos</h2>
            <Summary>
                <SummaryItem
                    v-for="(product, index) in myProducts"
                    :key="index"
                    :product="product"
                />
            </Summary>
            <Button @click="$inertia.visit(`/orders/${order.id}`)"
                >Volver</Button
            >
        </div>
    </div>
</template>

<script setup>
import Button from "@/Components/Button.vue";
import Summary from "@/Components/Order/Summary.vue";
import SummaryItem from "@/Components/Order/SummaryItem.vue";

const { order } = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

const myProducts = computed(() => {
    return order.allowed_products.map((product) => {
        return {
            id: product.id,
            name: product.name,
            quantity:
                order.products.find(
                    (orderProduct) => orderProduct.id === product.id
                )?.pivot.quantity || 0,
        };
    });
});
</script>

<script>
import Layout from "@/Layouts/Layout.vue";
import { computed } from "vue";

export default {
    layout: Layout,
};
</script>
