<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
defineOptions({
  layout: GuestLayout,
});
defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
};
</script>

<template>

    <Head title="Log in" />
    <ui-card>
        <ui-alert v-if="status" type="success">
            {{ status }}
        </ui-alert>

        <form @submit.prevent="submit">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">
                به سامانه مدیریت وارد شوید
            </h5>

            <ui-input name="email" type="text"  v-model="form.email" label="آدرس پست الکترونیکی" placeholder="آدرس پست الکترونیکی" :error="form.errors.email" />
            <ui-input name="password" placeholder="رمز عبور" type="password" v-model="form.password" label="رمز عبور" :error="form.errors.password" />

            <ui-toggle label="مرا به خاطر بسپار" v-model="form.remember" />

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                رمز عبور را فرآموش کرده اید؟
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    ورود به سیستم
                </PrimaryButton>
            </div>
        </form>
    </ui-card>
</template>
