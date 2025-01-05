<template>
  <div class="p-10">
    <form @submit.prevent="submit()">
      <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3">
          <ui-input label="عنوان" :error="form.errors.title" v-model="form.title" />
          <ui-input label="نامک" :error="form.errors.slug" v-model="form.slug" />
          <ui-textarea
            label="توضیحات"
            :error="form.errors.description"
            v-model="form.description"
          />
                  <!-- <ui-tag /> -->
            <ui-tag class="py-5" label="برچسب ها" :error="form.errors.tags" v-model="form.tags" />
        </div>
        <div>
          <ui-file
            accept="image/png, image/gif, image/jpeg"
            label="تصویر شاخص"
            :error="form.errors.featured_image"
            v-model="form.featured_image"
          />
        </div>
      </div>
      <ui-editor label="متن" :error="form.errors.content" v-model="form.content" />
      <button class="btn" type="submit">ارسال</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

defineOptions({
  layout: AuthenticatedLayout,
});

const form = useForm({
  title: "",
  description: "",
  content: "",
  slug: "",
  featured_image: "",
  tags: []
});

function submit() {
  form.post("/posts");
}
</script>
