<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
defineOptions({
  layout: GuestLayout,
});
defineProps<{
  status?: string;
}>();

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>

    <Head title="Forgot Password" />

    <ui-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            رمز عبور خود را فرآموش کرده اید؟‌نگران نباشید! فقط ایمیل خود را وارد کنید تا لینک
            بازنشانی رمز عبور برای شما ارسال شود.
        </div>
        <ui-alert v-if="status" type="success">
            {{ status }}
        </ui-alert>

        <form @submit.prevent="submit">
            <div>
                <ui-input type="email"  v-model="form.email" :error="form.errors.email"  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    رمز یکبار مصرف را برای من ایمیل کن
                </PrimaryButton>
            </div>
        </form>
    </ui-card>
</template>
