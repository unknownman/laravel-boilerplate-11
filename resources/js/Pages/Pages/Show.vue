<template>
    <div>
        <h1>صفحه نمایش تک صفحه</h1>
        <p>ID : {{ id }}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    id: String
})
</script>

<style  scoped>

</style>
