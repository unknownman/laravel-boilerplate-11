<template>
    <div>
        <button v-if="!isOpenNewCategory" @click="openNewCategory">دسته جدید</button>
        <ui-input v-model="form.name" v-if="isOpenNewCategory" />
        <ui-category-item :category="category" v-for="category in categories" />
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array
})

const form=useForm({
    name: ""
})

const isOpenNewCategory = ref(false)
function openNewCategory() {
    isOpenNewCategory.value = true
}

</script>

<style  scoped>

</style>
