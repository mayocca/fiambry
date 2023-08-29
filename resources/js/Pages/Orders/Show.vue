<template>
    <Head :title="`Pedido de ${order.user.name}`" />

    <n-page-header class="m-4" @back="router.visit('/')">
        <template #title>
            <span class="text-2xl font-light"
                >Pedido de {{ order.user.name }}</span
            >
        </template>
    </n-page-header>

    <div class="p-4 flex flex-col sm:flex-row gap-2">
        <n-card title="Sumario de productos">
            <Summary class="mb-2">
                <SummaryItem
                    v-for="(product, index) in products_summary"
                    :key="index"
                    :product="product"
                />
            </Summary>
            <n-button
                type="primary"
                ghost
                @click="$inertia.visit(`/orders/${order.id}/products/create`)"
                >Agregar productos</n-button
            >
        </n-card>

        <n-card title="Detalles">
            <OrderDetails :order="order" />
        </n-card>

        <div v-if="order.user_id === $page.props.auth.user?.id">
            <n-button type="info" @click="$inertia.visit(`/orders/${order.id}/edit`)">
                Editar detalles
            </n-button>
            <n-button type="primary" @click="$inertia.visit('/orders')">
                Finalizar
            </n-button>
        </div>
    </div>
</template>

<script setup>
import OrderDetails from "@/Components/Order/Details.vue";
import Summary from "@/Components/Order/Summary.vue";
import SummaryItem from "@/Components/Order/SummaryItem.vue";
import { Head, router } from "@inertiajs/vue3";
import { NButton, NCard, NPageHeader } from "naive-ui";

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
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
