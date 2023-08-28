<template>
    <Head title="Registrarse" />
    <div class="flex flex-col m-auto gap-4 max-w-fit min-h-[80vh]">
        <n-card>
            <form class="flex flex-col gap-4" @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center">Registrarse</h1>
                <div class="flex flex-col gap-2">
                    <label for="name" class="sr-only">Nombre</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="border-[0.5px] border-gray-300 rounded-sm p-1 font-light"
                        placeholder="Nombre"
                        v-model="form.name"
                        autofocus
                        required
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email" class="sr-only">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="border-[0.5px] border-gray-300 rounded-sm p-1 font-light"
                        placeholder="Email"
                        v-model="form.email"
                        required
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="sr-only">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="border-[0.5px] border-gray-300 rounded-sm p-1 font-light"
                        v-model="form.password"
                        required
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="sr-only"
                        >Confirmar Password</label
                    >
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirmar password"
                        class="border-[0.5px] border-gray-300 rounded-sm p-1 font-light"
                        v-model="form.password_confirmation"
                        required
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <n-button type="primary" attr-type="submit"
                        >Registrarse</n-button
                    >
                </div>
            </form>
        </n-card>
    </div>
</template>

<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { NButton, NCard } from "naive-ui";

defineProps({
    errors: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

function submit() {
    router.post("/register", form);
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
    layout: Layout,
};
</script>
