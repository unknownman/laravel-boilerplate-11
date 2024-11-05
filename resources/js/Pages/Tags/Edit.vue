<template>
  <div class="p-10">
    <form @submit.prevent="form.put('/tags/' + tag.id)" class="grid grid-cols-1 gap-8">
      <ui-input label="عنوان تگ" :error="form.errors.name" v-model="form.name" />
      <button class="btn" type="submit">ارسال</button>
    </form>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  tag: Object,
});
const form = useForm({
  name: props.tag.name,
});
</script>
