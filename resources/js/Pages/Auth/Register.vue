<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
defineOptions({
  layout: GuestLayout,
});
const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>

    <Head title="Register" />

    <ui-card>
        <form class="space-y-10" action="#" @submit.prevent="submit">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">
                در سامانه ثبت نام کنید
            </h5>

            <div class="space-y-6">
                <ui-input type="text" name="name" id="name" v-model="form.name" :error="form.errors.name"
                    label="نام شما" placeholder="نام کامل شما" />
                <ui-input type="email" name="email" id="email" v-model="form.email" :error="form.errors.email"
                    label="پست الکترونیکی" placeholder="آدرس پست الکترونیکی شما" />
                <ui-input type="password" name="password" id="password" v-model="form.password"
                    :error="form.errors.password" label="رمز عبور" placeholder="••••••••" required />
                <ui-input type="password" name="password_confirmation" id="password_confirmation"
                    v-model="form.password_confirmation" :error="form.errors.password_confirmation"
                    label="تکرار رمز عبور" placeholder="••••••••" required />
            </div>

            <div class="flex items-start">
                <Link href="/forgot-password" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">
                رمز عبور خود را فرآموش کرده اید؟</Link>
            </div>
            <button type="submit" :disabled="form.processing"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                ثبت نام حساب کاربری
            </button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                قبلا ثبت نام کرده اید
                <Link href="/login" class="text-blue-700 hover:underline dark:text-blue-500">ورود به حساب</Link>
            </div>
        </form>
    </ui-card>
</template>
