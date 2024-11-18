<template>
    <div>
        <ui-messenger-friends :users="users" @chat="handleChat" />
        <ui-messenger-chat :user="selectedUser" v-if="selectedUser" :selectedUser="selectedUser" />
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    users: Array
})
const page = usePage()
const selectedUser = ref(null)

function handleChat(e) {
    selectedUser.value = e
}
const echo = window.Echo
echo.channel("chat").listenToAll((e,data) => {
    console.log("new event", e, data);
})
</script>

<style  scoped>
div {
   @apply flex flex-row justify-start
}
</style>
