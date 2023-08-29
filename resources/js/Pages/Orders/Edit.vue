<template>
  <Head title="Editar pedido" />

  <n-page-header class="m-4" @back="router.visit(`/orders/${order.id}`)">
    <template #title>
      <span class="text-2xl font-light">Crear pedido</span>
    </template>
  </n-page-header>
  <form class="grid sm:grid-cols-2 gap-2 mx-4" @submit.prevent="submit">
    <n-card title="Productos disponibles" class="flex flex-col gap-2">
      <span class="block mb-4">Agrega los productos que podrán ser seleccionados</span>
      <n-space vertical justify="center">
        <n-input-group v-for="(product, index) in form.allowed_products" :key="index">
          <n-input v-model:value="product.name" placeholder="Nombre" />
          <n-button type="error" tabindex="-1" @click="removeInput(index)">
            <template #icon>
              <n-icon>
                <Remove />
              </n-icon>
            </template>
          </n-button>
        </n-input-group>

        <n-input-group>
          <n-input disabled placeholder="Nombre" />
          <n-button type="primary" @click="addInput">
            <template #icon>
              <n-icon>
                <Add />
              </n-icon>
            </template>
          </n-button>
        </n-input-group>
      </n-space>
    </n-card>

    <n-card title="Detalles del pedido">
      <textarea
        v-model="form.details"
        class="border border-gray-200 rounded p-2 w-full resize-none text-sm"
        placeholder="Observaciones, instrucciones de pago, etc."
        rows="3"
      ></textarea>
    </n-card>

    <n-button
      type="primary"
      attr-type="submit"
      :disabled="form.processing || form.allowed_products.length === 0"
      >Confirmar</n-button
    >
  </form>
</template>

<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { NButton, NCard, NIcon, NInput, NInputGroup, NPageHeader, NSpace } from "naive-ui";
import { Add, Remove } from "@vicons/ionicons5";

const { order } = defineProps({
  order: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  allowed_products: [
    ...order.allowed_products.map((product) => ({ name: product.name })),
    { name: "" },
  ],
  details: null,
});

function submit() {
  let allowed_products = form.allowed_products.filter((product) => product.name !== "");

  router.put(`/orders/${order.id}`, { ...form, allowed_products });
}

function addInput() {
  form.allowed_products.push({ name: "" });
}

function removeInput(index) {
  form.allowed_products.splice(index, 1);
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
  layout: Layout,
};
</script>
