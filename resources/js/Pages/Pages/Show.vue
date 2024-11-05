<template>
    <div class="grid grid-cols-1 gap-4">
        <h1 class="font-bold">{{ page.title }}</h1>
        <p>{{ page.content }}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    id: String,
    page: Object
})
defineOptions({
    layout: DefaultLayout
})

</script>

<style  scoped>

</style>
