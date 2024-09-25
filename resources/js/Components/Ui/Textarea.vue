<template>
  <div class="mt-2 border-0">
    <label :for="name" :class="{ 'text-red-700 dark:text-red-500': error }">
      {{ label }}
    </label>
    <textarea
      v-bind="$attrs"
      class="textarea"
      row="4"
      :class="{
        error: error,
      }"
      :placeholder="placeholder"
      v-model="model"
    />
    <p v-if="error">
      {{ error }}
    </p>
  </div>
</template>

<script setup>
import { useVModel } from "@vueuse/core";

const props = defineProps({
  modelValue: String,
  error: {
    type: [Boolean, String],
    default: false,
  },
  placeholder: String,
  label: String,
});

const emit = defineEmits(["update:modelValue"]);

const model = useVModel(props, "modelValue", emit);
</script>

<style scoped>
p {
  @apply mt-2 text-sm text-red-600 ;
}
</style>
