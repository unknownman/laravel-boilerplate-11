<template>
  <div>
    <button class="new" v-if="!isOpenNewCategory" @click="openNewCategory">دسته جدید</button>
    <div v-if="isOpenNewCategory" class="grid grid-cols-2 gap-4">
      <ui-input v-model="form.name" />
      <button @click="submitForm">اضافه کن</button>
    </div>
    <ui-category-item :category="category" v-for="category in categories" />
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  categories: Array,
});

const form = useForm({
  name: "",
});
const isOpenNewCategory = ref(false);

function submitForm() {
  form.post("/categories", {
    onFinish: () => {
      form.reset();
      isOpenNewCategory.value = false;
    },
  });
}

function openNewCategory() {
  isOpenNewCategory.value = true;
}
</script>

<style scoped>
.new {
    @apply ms-5 text-sm my-2  bg-blue-700 text-white px-2 py-1 rounded-lg hover:shadow-xl hover:shadow-blue-400
}
</style>
