<template>
  <div>
    <button @click="toggle()" v-if="category.children">
      <span v-if="isOpen">-</span>
      <span v-else>+</span>
    </button>
    <span :class="{ 'font-bold': isOpen }">{{ category.name }}</span>
  </div>
  <div class="ps-5" v-if="isOpen">
    <ui-category :categories="category.children" />
  </div>
</template>

<script setup>
import { useToggle } from '@vueuse/core';


const props = defineProps({
  category: Object,
});

const isOpen = ref(false);
const toggle=useToggle(isOpen)
</script>

<style scoped>
button {
    @apply px-2 rounded-full bg-white me-2
}
</style>
