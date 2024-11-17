<template>
    <div>
        <ui-messenger-friends :users="users" />
        <ui-messenger-chat :user="selectedUser" v-if="selectedUser" />
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    users: Array
})
const page = usePage()
const selectedUser = ref(null)
const echo = window.Echo
echo.channel("chat").listenToAll((e,data) => {
    console.log("new event", e, data);
})
</script>

<style  scoped>

</style>
