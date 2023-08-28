<template>
  <n-layout>
    <n-layout-header>
      <nav
        class="sticky top-0 flex flex-col sm:flex-row gap-2 items-center justify-between px-4 py-2 bg-white border-[0.5px] border-b-gray-400"
      >
        <Link href="/">
          <span
            class="font-bold text-2xl sm:text-4xl from-blue-700 via-orange-400 to-pink-500 bg-gradient-to-br bg-clip-text text-transparent"
            >Fiambry</span
          >
        </Link>

        <n-button v-if="!$page.props.auth.user" type="primary" @click="$inertia.visit('/login')"
          ><template #icon>
            <n-icon> <LogIn /> </n-icon></template
          >Login</n-button
        >

        <div v-else class="flex items-center gap-2">
          <div class="flex flex-col text-sm leading-none">
            <span class="font-light">Bienvenido</span
            ><span class="font-bold">{{ $page.props.auth.user.name }}</span>
          </div>
          <n-button type="primary" @click="$inertia.post('/logout')"
            ><template #icon>
              <n-icon> <LogOut /> </n-icon></template
            >Logout</n-button
          >
        </div>
      </nav>
    </n-layout-header>
    <n-layout-content>
      <slot />
    </n-layout-content>
  </n-layout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { LogIn, LogOut } from "@vicons/ionicons5";
import { NButton, NIcon, NLayout, NLayoutContent, NLayoutHeader } from "naive-ui";
</script>
