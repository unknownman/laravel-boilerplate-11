<template>
  <div
    class="w-full  p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
  >
    <div v-bind="$attrs">
      <slot />
    </div>
  </div>
</template>
