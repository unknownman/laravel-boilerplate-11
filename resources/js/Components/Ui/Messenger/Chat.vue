<template>
    <div id="chat">
        <header>
            {{ user.name }}
        </header>
        <section>
            chat content
        </section>
        <footer>
            <input class="input" v-model="form.message" />
            <button @click="sendMessage" >ارسال</button>
        </footer>

    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
const page = usePage()
const currentUSer = page.props.auth.user
const messages = ref([])
const props = defineProps({
    user: Object
})
const form = useForm({
    message: ""
})

async function getMessages(u) {
    await axios.get(`/meesenger/${u.id}`).then((response) => {
        messages.value = response.data();
    })
}

await getMessages(props.user)
</script>

<style  scoped>
div#chat {
    @apply flex flex-col place-content-start flex-grow h-screen overflow-y-auto relative
}
header {
    @apply h-12 flex flex-col place-items-start place-content-center bg-slate-500 w-full text-white ps-5 font-black
}
footer {
    @apply absolute bottom-0 bg-slate-500 w-full p-5 h-20 flex flex-row gap-2
}
footer > .input {
    @apply flex-grow
}
</style>
