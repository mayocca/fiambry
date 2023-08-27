<template>
    <nav
        class="sticky top-0 flex gap-2 items-center justify-between px-4 py-2 mb-4 border-[0.5px] border-b-gray-400"
    >
        <Link href="/">
            <span
                class="font-bold text-2xl sm:text-4xl from-blue-700 via-orange-400 to-pink-500 bg-gradient-to-br bg-clip-text text-transparent"
            >
                fiambres
            </span>
        </Link>

        <Button v-if="!auth.user" @click="$inertia.visit('/login')"
            >Login</Button
        >
        <Button v-else @click="$inertia.post('/logout')">Logout</Button>
    </nav>
    <slot />
</template>

<script setup>
import Button from "@/Components/Button.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    auth: Object,
});
</script>
