<template>
    <ul>
        <li v-for="u,i in users" @click="onChatWith(u)">{{ u.name }}</li>
    </ul>
</template>

<script setup>
const props = defineProps({
    users: Array
})
const emit = defineEmits(["chat"])

function onChatWith(u) {
    emit("chat", u);
}
</script>

<style scoped>
ul {
    @apply w-1/4 max-w-xs overflow-y-auto overflow-x-hidden bg-slate-200 h-screen
}
li {
    @apply h-12 flex flex-col place-content-center place-items-start ps-5  cursor-pointer hover:bg-white hover:shadow-inner
}
</style>
