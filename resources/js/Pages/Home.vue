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
