<template>
  <div class="mt-2 border-0" v-bind="$attrs">
    <label :class="{ 'text-red-700 dark:text-red-500': error }">{{ label }}</label>
    <span v-for="tag in model">
      {{ tag.name }}
      <button type="button" @click="removeTag(tag)">
        <svg
          class="w-2 h-2"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
          />
        </svg>
      </button>
    </span>
    <input
      @keyup.prevent="handleKeyPress"
      v-model="form.name"
      :style="`width:${form.name.length > 4 ? form.name.length * 15 : 60}px`"
    />
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { useVModel } from "@vueuse/core";
import { useCookies } from "@vueuse/integrations/useCookies";

const props = defineProps({
  modelValue: Array,
  label: String,
  error: {
    type: [Boolean, Array],
    default: false,
  },
});
const form = useForm({
  name: "",
});

const cookies = useCookies(["locale"]);

const emit = defineEmits(["update:modelValue"]);
const model = useVModel(props, "modelValue", emit);

async function handleKeyPress(event) {
  if (event.key === "Enter" || event.key === ",") {
    form.name = form.name.replace(",", "");
    const response = await fetch("/tags", {
      method: "POST",
      body: JSON.stringify({
        name: form.name,
      }),
      headers: {
        "Content-Type": "application/json",
        "X-XSRF-TOKEN": cookies.get("XSRF-TOKEN"),
      },
    });

    console.log(response)
    if (!response.ok) {
      throw new Error("Network error!");
    }

    const data = await response.json();
    if (data.tag && data.tag.name) {
      if (
        !model.value.some((tag) => tag.name.toLowerCase() === data.tag.name.toLowerCase())
      ) {
        model.value = [...model.value, data.tag];
      }
      form.reset();
    }
  }
}

function removeTag(tag) {
  const index = model.value.findIndex(
    (t) => t.name.toLowerCase() === tag.name.toLowerCase()
  );

  if (index !== -1) {
    model.value.splice(index, 1);
    return true;
  }
  return false;
}
</script>
<style scoped>
span {
  @apply inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300;
}
button {
  @apply inline-flex items-center p-1 ms-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300;
}
input {
    @apply rounded-lg bg-gray-200 border-0 outline-0 ring-0 shadow-inner
}
</style>
