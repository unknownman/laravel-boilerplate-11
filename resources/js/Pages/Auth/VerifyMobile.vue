<template>
    <div>
        <input v-model="form.otp" />
        <button @click="submit" >ارسال</button>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

const form = useForm({
    otp: '',
    mobile: props.user.mobile
})

function submit() {
    form.post('/auth/mobile/verify')
}
</script>

<style scoped>
div {
    @apply flex flex-col h-screen place-content-center place-items-center gap-4;
}

input {
    @apply rounded-lg bg-slate-100 text-4xl max-w-sm lg:text-5xl text-slate-700 border-none outline-none focus:ring-0 text-center placeholder-slate-200
}

button {
    @apply inline-block w-auto text-center px-6 py-4 text-white transition-all rounded-md shadow-xl sm:w-auto bg-gradient-to-r from-blue-600 to-blue-500 hover:bg-gradient-to-b dark:shadow-blue-900 shadow-blue-200 hover:shadow-2xl hover:shadow-blue-400 cursor-pointer hover:-translate-x-1 hover:-translate-y-1 disabled:from-slate-600 disabled:to-slate-500 disabled:hover:-translate-x-0 disabled:hover:-translate-y-0
}

.error {
    @apply text-red-600
}

.valid {
    @apply bg-green-100 border-2 border-green-500
}
</style>
