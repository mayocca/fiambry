<template>
    <div class="max-w-prose mx-4">
        <h1 class="text-2xl font-thin">Crear pedido</h1>
        <form @submit.prevent="submit">
            <div class="flex flex-col gap-4">
                <label for="name">Nombre</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="border border-gray-300 rounded-md"
                />
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const form = reactive({
    name: "",
    email: "",
    phone: "",
    address: "",
    products: [],
    total: 0,
});

function submit() {
    router.post("/orders", form);
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
