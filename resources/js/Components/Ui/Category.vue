<template>
    <div>
        <ui-category-item :category="category" v-for="category in categories" />
    </div>
</template>

<script setup>
const props = defineProps({
    categories: Array
})
</script>

<style  scoped>

</style>
