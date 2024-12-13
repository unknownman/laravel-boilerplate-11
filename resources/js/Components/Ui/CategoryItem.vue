<template>
  <div class="line">
    <button @click="toggle()" >
      <span v-if="isOpen">-</span>
      <span v-else>+</span>
    </button>
    <span :class="{ 'font-bold': isOpen }">{{ category.name }}</span>
  </div>
  <div class="ps-5 line" v-if="isOpen">
    <ui-category :categories="category.children" :parentId="category.id" />
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
.line {
    @apply border-l border-l-slate-500 ms-10 rounded-sm ps-2 pb-2 text-slate-800 text-xl
}
.line .line {
    @apply border-l-slate-400 text-slate-700 text-lg
}
.line .line .line {
    @apply border-l-slate-300 text-slate-600 text-base
}
.line .line .line .line {
    @apply border-l-slate-200 text-slate-500 text-sm
}
</style>
