<template>
    <nav
        class="sticky top-0 flex flex-col sm:flex-row gap-2 items-center justify-between px-4 py-2 mb-4 bg-white border-[0.5px] border-b-gray-400"
    >
        <Link href="/">
            <span
                class="font-bold text-2xl sm:text-4xl from-blue-700 via-orange-400 to-pink-500 bg-gradient-to-br bg-clip-text text-transparent"
                >Fiambry</span
            >
        </Link>

        <Button v-if="!auth.user" @click="$inertia.visit('/login')"
            >Login</Button
        >
        <div v-else class="flex items-center gap-2">
            <div class="flex flex-col text-sm leading-none">
                <span class="font-light">Bienvenido</span
                ><span class="font-bold">{{ auth.user.name }}</span>
            </div>
            <Button @click="$inertia.post('/logout')">Logout</Button>
        </div>
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
