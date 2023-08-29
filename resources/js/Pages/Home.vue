<template>
  <div class="flex flex-col gap-4 max-w-prose p-4 m-auto">
    <n-card title="Pedidos">
      Crea un pedido, donde podrás elegir qué productos estarán disponibles para que tus compañeros
      puedan pedirlos.
      <template #action>
        <n-button type="primary" @click="$inertia.visit('/orders/create')">Crear pedido</n-button>
      </template>
    </n-card>
  </div>
</template>

<script setup>
import { NButton, NCard } from "naive-ui";
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
  layout: Layout,
};
</script>
