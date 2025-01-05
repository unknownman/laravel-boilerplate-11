<template>
  <div>
    <button class="new" v-if="!isOpenNewCategory" @click="openNewCategory">دسته جدید</button>
    <div v-if="isOpenNewCategory" class="newCategory">
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
  parentId: {
    default: null,
    type: Number
  }
});

const form = useForm({
  name: "",
  parent_id: props.parentId
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
    @apply  ms-5 text-sm my-2  bg-gray-700 hover:bg-blue-600 text-white px-2 py-1 rounded-lg hover:shadow-xl hover:shadow-blue-300 hover:-translate-x-1 hover:-translate-y-1
}
.newCategory {
    @apply p-2 flex flex-row justify-start gap-2 items-center
}
.newCategory button {
    @apply bg-blue-300 p-2 rounded-lg text-sm mt-3 text-blue-800
}
</style>
