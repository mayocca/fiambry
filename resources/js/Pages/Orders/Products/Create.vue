<template>
  <Head title="Agregar productos" />

  <n-page-header class="m-4" @back="router.visit(`/orders/${order.id}`)">
    <template #title>
      <span class="text-2xl font-light">Agregar productos</span>
    </template>
  </n-page-header>

  <div class="px-4">
    <n-card title="Mis productos" class="max-w-prose">
      <div class="flex flex-col gap-2">
        <template v-for="(product, index) in products" :key="index">
          <n-input-group class="flex">
            <n-input-group-label class="flex-grow">{{ product.name }}</n-input-group-label>
            <n-input-number
              v-model:value="product.quantity"
              class="w-[10ch]"
              :default-value="0"
              :validator="(value) => value >= 0"
            />
          </n-input-group>
        </template>
      </div>

      <template #action>
        <n-space justify="end">
          <n-button type="error" ghost @click="$inertia.visit(`/orders/${order.id}`)">
            Cancelar
          </n-button>

          <n-button type="primary" @click="save">Confirmar</n-button>
        </n-space>
      </template>
    </n-card>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import {
  NButton,
  NCard,
  NInputGroup,
  NInputGroupLabel,
  NInputNumber,
  NPageHeader,
  NSpace,
} from "naive-ui";
import { Head, router } from "@inertiajs/vue3";

const { order } = defineProps({
  order: {
    type: Object,
    required: true,
  },
});

const { products } = reactive({
  products: order.allowed_products.map((product) => ({
    ...product,
    quantity: order.products.find((p) => p.id === product.id)?.pivot?.quantity || 0,
  })),
});

function save() {
  router.post(`/orders/${order.id}/products`, {
    products: products
      .filter((product) => product.quantity > 0)
      .map((product) => ({
        id: product.id,
        quantity: product.quantity,
      })),
  });
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
  layout: Layout,
};
</script>
