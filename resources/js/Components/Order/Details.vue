<template>
  <div class="flex flex-col">
    <span v-if="order.details" class="text-gray-500 font-light text-sm italic">{{
      order.details
    }}</span>

    <span class="text-gray-500 font-light text-xs italic">Creado por {{ order.user.name }}</span>
  </div>
</template>

<script setup>
defineProps({
  order: {
    type: Object,
    required: true,
  },
});
</script>
