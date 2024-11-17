<template>
    <div>
        <header>
            {{ user.name }}
        </header>
        <section>
            chat content
        </section>
        <footer>
            <ui-input v-model="form.message" />
            <button @click="sendMessage" >ارسال</button>
        </footer>

    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})
const form = useForm({
    message: ""
})
</script>

<style  scoped>

</style>
