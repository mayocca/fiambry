<template>
    <Head title="Crear pedido" />
    <div
        class="flex flex-col items-center gap-4 max-w-prose m-auto border-y-2 sm:border-x-2 sm:rounded border-gray-200 p-4"
    >
        <h1 class="text-2xl font-medium">Crear pedido</h1>
        <form @submit.prevent="submit" class="flex flex-col items-center gap-2">
            <span class="text-gray-500 font-light"
                >Agrega los productos que estarán disponibles en el pedido</span
            >
            <div
                v-for="(product, index) in form.allowed_products"
                class="flex items-center space-x-2"
                :key="index"
            >
                <input
                    v-model="product.name"
                    class="border border-gray-200 rounded px-4 py-1 w-64 text-xs font-light"
                    placeholder="Nombre"
                    type="text"
                    :required="index !== form.allowed_products.length - 1"
                    @keypress="
                        index === form.allowed_products.length - 1 && addInput()
                    "
                />
                <button
                    :disabled="
                        form.allowed_products.length === 1 ||
                        index === form.allowed_products.length - 1
                    "
                    type="button"
                    class="text-red-300"
                    :class="{
                        'cursor-not-allowed':
                            form.allowed_products.length === 1 ||
                            index === form.allowed_products.length - 1,
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

            <span class="text-gray-500 font-light mt-8"
                >Agrega una descripción del pedido</span
            >

            <textarea
                v-model="form.details"
                class="border border-gray-200 rounded p-2 w-full resize-none text-sm"
                placeholder="Detalles, instrucciones de pago, etc."
                rows="3"
            ></textarea>

            <n-button type="primary" attr-type="submit">Confirmar</n-button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";
import { NButton } from "naive-ui";

const form = reactive({
    allowed_products: [{ name: "" }],
    details: null,
});

function submit() {
    let allowed_products = form.allowed_products.filter(
        (product) => product.name !== ""
    );

    router.post("/orders", { ...form, allowed_products });
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
