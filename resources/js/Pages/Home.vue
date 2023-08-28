<template>
    <div class="flex flex-col m-auto gap-4 max-w-fit min-h-[80vh]">
        <n-button type="primary" @click="$inertia.visit('/orders/create')"
            >Crear pedido</n-button
        >
    </div>
</template>

<script setup>
import { NButton } from "naive-ui";
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
