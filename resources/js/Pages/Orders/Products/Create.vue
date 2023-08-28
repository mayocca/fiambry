<template>
  <Head title="Agregar productos" />

  <n-page-header class="m-4" @back="$inertia.visit(`/orders/${order.id}`)">
    <template #title>
      <span class="text-2xl font-light">Agregar productos</span>
    </template>
  </n-page-header>

  <div class="px-4">
    <n-card title="Mis productos" class="max-w-prose">
      <n-space vertical>
        <template v-for="(product, index) in products" :key="index">
          <n-input-group>
            <n-input-group-label class="w-[48ch]">{{ product.name }}</n-input-group-label>
            <n-input-number
              v-model:value="product.quantity"
              class="w-full"
              :default-value="0"
              :validator="(value) => value >= 0"
            />
          </n-input-group>
        </template>

        <n-space justify="end">
          <n-button type="error" ghost @click="$inertia.visit(`/orders/${order.id}`)">
            Cancelar
          </n-button>

          <n-button type="primary" @click="save">Confirmar</n-button>
        </n-space>
      </n-space>
    </n-card>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import {
  NButton,
  NCard,
  NGrid,
  NGridItem,
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
