<template>
    <ui-category :categories="categories" />
</template>

<script setup>


defineOptions({
    layout: AuthenticatedLayout
})
const props = defineProps({
    categories: Array
})
</script>

<style  scoped>

</style>
