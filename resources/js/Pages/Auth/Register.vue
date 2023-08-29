<template>
  <Head title="Registrarse" />
  <div class="p-4 sm:p-20 h-[80vh] m-auto gap-4 max-w-prose">
    <n-card>
      <n-form :model="form" :show-label="true">
        <h1 class="text-2xl font-bold text-center">Registrarse</h1>

        <n-form-item
          path="name"
          label="Nombre"
          :validation-status="$page.props.errors.name ? 'error' : null"
          :feedback="$page.props.errors.name ?? null"
        >
          <n-input v-model:value="form.name" placeholder="John Doe" autofocus />
        </n-form-item>

        <n-form-item
          path="email"
          label="Email"
          :validation-status="$page.props.errors.email ? 'error' : null"
          :feedback="$page.props.errors.email ?? null"
        >
          <n-input v-model:value="form.email" placeholder="john.doe@example.com" />
        </n-form-item>

        <n-form-item
          path="password"
          label="Password"
          :validation-status="$page.props.errors.password ? 'error' : null"
          :feedback="$page.props.errors.password ?? null"
        >
          <n-input v-model:value="form.password" type="password" placeholder="password" />
        </n-form-item>

        <n-form-item
          path="password_confirmation"
          label="Confirmar password"
          :validation-status="$page.props.errors.password_confirmation ? 'error' : null"
          :feedback="$page.props.errors.password_confirmation ?? null"
        >
          <n-input
            v-model:value="form.password_confirmation"
            type="password"
            placeholder="password"
          />
        </n-form-item>

        <n-space justify="space-between" class="mt-4">
          <n-button secondary type="primary" @click="$inertia.visit('/login')">Login</n-button>
          <n-button type="primary" attr-type="submit" @click="submit">Registrarse</n-button>
        </n-space>
      </n-form>
    </n-card>
  </div>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { NButton, NCard, NForm, NFormItem, NInput, NSpace } from "naive-ui";

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
});

function submit() {
  form.post("/register", {
    onError: (errors) => {
      form.reset("password");
    },
  });
}
</script>

<script>
import Layout from "@/Layouts/Layout.vue";

export default {
  layout: Layout,
};
</script>
