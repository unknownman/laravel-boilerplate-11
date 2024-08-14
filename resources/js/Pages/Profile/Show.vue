<template>
    <div>
        <h1>{{ user.email }}</h1>
        <p>{{ user.profile.bio }}</p>
    </div>
</template>

<script setup>
const props = defineProps({user: Object})
</script>

<style  scoped>

</style>
