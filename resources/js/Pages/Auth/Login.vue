<template>
    <!-- Card -->
    <div
        class="flex flex-col m-auto gap-4 w-96 border-[0.5px] border-gray-400 rounded-md shadow-md p-8"
    >
        <h1 class="text-2xl font-bold text-center">Login</h1>

        <form class="flex flex-col gap-4" @submit.prevent="submit">
            <div class="flex flex-col gap-2">
                <label for="email" class="sr-only">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="border-[0.5px] border-gray-400 rounded-md p-2"
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
                    class="border-[0.5px] border-gray-400 rounded-md p-2"
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
                <Button type="submit">Login</Button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import Button from "@/Components/Button.vue";

defineProps({
    errors: {
        type: Object,
        required: true,
    },
});

const form = reactive({
    email: null,
    password: null,
    remember: false,
});

function submit() {
    router.post("/login", form);
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";
import { router } from "@inertiajs/vue3";

export default {
    layout: Layout,
};
</script>
