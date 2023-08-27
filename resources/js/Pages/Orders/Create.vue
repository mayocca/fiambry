<template>
    <div
        class="flex flex-col items-center gap-4 max-w-prose m-auto border-y-2 sm:border-x-2 sm:rounded border-gray-200 p-4"
    >
        <h1 class="text-2xl font-light">Crear pedido</h1>
        <span class="text-gray-500 font-light"
            >Agrega los productos que estarán disponibles en el pedido</span
        >
        <form @submit.prevent="submit" class="flex flex-col gap-2">
            <div
                v-for="(product, index) in form.allowed_products"
                class="flex items-center space-x-2"
                :key="index"
            >
                <input
                    v-model="product.name"
                    class="border border-gray-200 rounded p-2 w-64"
                    placeholder="Nombre"
                    type="text"
                    @keypress="
                        index === form.allowed_products.length - 1 && addInput()
                    "
                />
                <button
                    :disabled="form.allowed_products.length === 1"
                    type="button"
                    class="text-red-300"
                    :class="{
                        'cursor-not-allowed':
                            form.allowed_products.length === 1,
                    }"
                    tabindex="-1"
                    @click="removeInput(index)"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <Button type="submit">Confirmar</Button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";

const form = reactive({
    allowed_products: [{ name: "" }],
});

function submit() {
    let allowed_products = form.allowed_products.filter(
        (product) => product.name !== ""
    );

    router.post("/orders", { allowed_products });
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
