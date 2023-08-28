<template>
    <Head title="Agregar productos" />

    <div class="p-4">
        <n-page-header @back="$inertia.visit(`/orders/${order.id}`)">
            <template #title>
                <span class="text-2xl font-light">Agregar productos</span>
            </template>
        </n-page-header>

        <n-card title="Mis productos" class="max-w-prose m-auto">
            <div class="flex flex-col items-center gap-4 w-full row-[1/-1]">
                <Summary>
                    <SummaryItem
                        v-for="(product, index) in myProducts"
                        :key="index"
                        :product="product"
                    />
                </Summary>
                <n-button @click="$inertia.visit(`/orders/${order.id}`)"
                    >Volver</n-button
                >
            </div>
        </n-card>
    </div>
</template>

<script setup>
import Summary from "@/Components/Order/Summary.vue";
import SummaryItem from "@/Components/Order/SummaryItem.vue";
import { computed } from "vue";
import { NButton, NCard, NPageHeader } from "naive-ui";
import { Head } from "@inertiajs/vue3";

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

export default {
    layout: Layout,
};
</script>
