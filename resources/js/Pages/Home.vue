<template>
    <div class="flex flex-col m-auto gap-4 max-w-fit min-h-[80vh]">
        <Button @click="$inertia.visit('/orders/create')">Crear pedido</Button>
    </div>
</template>

<script setup>
import Button from "@/Components/Button.vue";
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
