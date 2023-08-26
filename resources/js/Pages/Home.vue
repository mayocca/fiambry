<template>
    <Layout>
        <div class="flex flex-col items-center gap-4">
            <h1
                class="font-bold text-3xl sm:text-6xl from-blue-700 via-orange-400 to-pink-500 bg-gradient-to-br bg-clip-text text-transparent"
            >
                fiambres
            </h1>
            <Link href="/orders/create">
                <Button title="Crear pedido" />
            </Link>
        </div>
    </Layout>
</template>

<script setup>
import Button from "@/Components/Button.vue";
import Layout from "@/Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";
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
