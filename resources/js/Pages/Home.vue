<template>
    <div class="flex flex-col m-auto gap-4 max-w-fit min-h-[80vh]">
        <Link href="/orders/create">
            <Button title="Crear pedido" />
        </Link>
    </div>
</template>

<script setup>
import Button from "@/Components/Button.vue";
import { Link } from "@inertiajs/vue3";
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>

<style scoped lang="scss">
$border-radius: 2px;

.gradient-border {
    border-radius: $border-radius;
}
.gradient-border::after {
    $extra: 2px;
    content: "";
    position: absolute;
    inset: -$extra;
    z-index: -1;
    background: linear-gradient(to bottom right, #3b82f6, #f59e0b, #ef4444);
    background-clip: padding-box;
    border-radius: $border-radius + $extra;
}
</style>
