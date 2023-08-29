<template>
  <Head title="Login" />
  <div class="p-4 sm:p-20 h-[80vh] m-auto gap-4 max-w-prose">
    <n-card>
      <n-form :model="form" :show-label="true">
        <h1 class="text-2xl font-bold text-center">Login</h1>

        <n-form-item
          path="email"
          label="Email"
          :validation-status="$page.props.errors.email ? 'error' : null"
          :feedback="$page.props.errors.email ?? null"
        >
          <n-input v-model:value="form.email" placeholder="john.doe@example.com" autofocus />
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
          path="remember"
          label="Recordarme"
          show-label
          label-placement="left"
          :show-feedback="false"
        >
          <n-checkbox v-model:checked="form.remember" />
        </n-form-item>
        <n-space justify="space-between" class="mt-4">
          <n-button secondary type="primary" @click="$inertia.visit('/register')"
            >Registrarse</n-button
          >
          <n-button type="primary" attr-type="submit" @click="submit">Iniciar sesión</n-button>
        </n-space>
      </n-form>
    </n-card>
  </div>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { NButton, NCard, NCheckbox, NForm, NFormItem, NInput, NSpace } from "naive-ui";

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

export default {
  layout: Layout,
};
</script>
