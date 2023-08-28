<template>
    <div class="flex flex-col m-auto gap-4 max-w-fit min-h-[80vh]">
        <div
            class="flex flex-col border-[0.5px] border-gray-300 rounded-sm shadow-md p-8 mx-4"
        >
            <form class="flex flex-col gap-4" @submit.prevent="submit">
                <h1 class="text-2xl font-bold text-center">Login</h1>
                <div class="flex flex-col gap-2">
                    <span
                        v-if="form.errors.email"
                        class="text-red-500 text-[0.6rem] text-center"
                        >{{ form.errors.email }}</span
                    >
                    <label for="email" class="sr-only">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="border-[0.5px] border-gray-300 rounded-sm p-1 font-light"
                        :class="{
                            'border-red-500 border-2': form.errors.email,
                        }"
                        placeholder="Email"
                        v-model="form.email"
                        autofocus
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

                <div class="flex flex-row items-center justify-center gap-2">
                    <label for="remember" class="font-extralight"
                        >Remember me</label
                    >
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        v-model="form.remember"
                    />
                </div>

                <div class="flex flex-col gap-2">
                    <n-button type="primary" attr-type="submit">Login</n-button>
                </div>
            </form>

            <div class="h-[0.5px] bg-gray-400 my-4" />

            <n-button
                secondary
                type="primary"
                @click="$inertia.visit('/register')"
                >Registrarse</n-button
            >
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { NButton } from "naive-ui";

defineProps({
    errors: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    email: null,
    password: null,
    remember: false,
});

function submit() {
    form.post("/login", {
        onError: (errors) => {
            form.reset("password");
        },
    });
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";
import { router } from "@inertiajs/vue3";

export default {
    layout: Layout,
};
</script>
