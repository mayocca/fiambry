<template>
    <Head :title="`Pedido de ${order.user.name}`" />

    <div class="p-4">
        <n-page-header @back="router.visit('/')">
            <template #title>
                <span class="text-2xl font-light"
                    >Pedido de {{ order.user.name }}</span
                >
            </template>
        </n-page-header>

        <div class="flex flex-col sm:grid sm:grid-rows-2 sm:grid-cols-2 gap-4">
            <div class="flex flex-col items-center gap-4">
                <h2 class="text-gray-500">Detalles del pedido</h2>
                <OrderDetails :order="order" />
            </div>

            <div class="flex flex-col items-center gap-4 row-[1/-1]">
                <h2 class="text-gray-500">Resumen del pedido</h2>
                <Summary>
                    <SummaryItem
                        v-for="(product, index) in products_summary"
                        :key="index"
                        :product="product"
                    />
                </Summary>
                <n-button
                    type="info"
                    @click="
                        $inertia.visit(`/orders/${order.id}/products/create`)
                    "
                    >Agregar productos</n-button
                >
            </div>

            <div
                v-if="order.user_id === $page.props.auth.user?.id"
                class="flex flex-col items-center gap-4 mt-auto ms-auto"
            >
                <n-button type="info" @click="$inertia.visit('/orders')">
                    Editar detalles
                </n-button>
                <n-button type="primary" @click="$inertia.visit('/orders')">
                    Finalizar
                </n-button>
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
import SummaryItem from "@/Components/Order/SummaryItem.vue";
import Layout from "@/Layouts/Layout.vue";
import { Head, router } from "@inertiajs/vue3";
import { NButton, NPageHeader } from "naive-ui";

export default {
    layout: Layout,
};
</script>
