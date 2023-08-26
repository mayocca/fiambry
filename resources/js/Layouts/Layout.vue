<template>
    <nav
        class="sticky top-0 flex justify-center py-2 mb-4 border-[0.5px] border-b-gray-400"
    >
        <Link href="/">
            <span
                class="font-bold text-2xl sm:text-4xl from-blue-700 via-orange-400 to-pink-500 bg-gradient-to-br bg-clip-text text-transparent"
            >
                fiambres
            </span>
        </Link>
    </nav>
    <slot />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
