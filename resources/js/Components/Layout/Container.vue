<template>
  <div>
    <slot />
  </div>
</template>

<script setup></script>

<style scoped>
div {
  @apply flex flex-col md:flex-row gap-10 py-12 px-8;
}
</style>
