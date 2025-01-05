<template>
    <ul>
        <li v-for="u,i in users" @click="onChatWith(u)" :class="{'selected': selectedUser && selectedUser.id && selectedUser.id === u.id }">{{ u.name }}</li>
    </ul>
</template>

<script setup>
const props = defineProps({
    users: Array,
    selectedUser: Object
})
const emit = defineEmits(["chat"])

function onChatWith(u) {
    emit("chat", u);
}
</script>

<style scoped>
ul {
   @apply  w-2/5 lg:w-1/5 border-r-2 overflow-y-auto overflow-x-hidden h-screen
}
li {
    @apply border-b-2 border-gray-50 h-12 flex flex-col place-content-center place-items-start ps-5  cursor-pointer hover:bg-white hover:shadow-inner
}
.selected {
    @apply bg-white border-l-4 border-blue-400  bg-blue-50 -me-1 shadow-inner
 }
</style>
