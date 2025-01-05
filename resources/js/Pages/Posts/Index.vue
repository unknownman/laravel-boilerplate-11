<template>
  <div v-if="flash.success" class="alert-success">
    {{ flash.success }}
  </div>
  <div class="grid grid-cols-1 gap-10">
    <div v-for="post in posts" >
      <Link :href="`/post/${post.id}/${post.slug}`" class="block mb-4">
        <h1 class="font-bold">{{ post.title }}</h1>
        <p>{{ post.description }}</p>
      </Link>
      <Link
        v-if="page.props.auth.user"
        class="btn  "
        :href="`/posts/edit/${post.id}`"
        >ویرایش</Link
      >
    </div>
  </div>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
  posts: Array,
  flash: [Array, Object],
});

const page = usePage();

defineOptions({
  layout: DefaultLayout,
});
</script>

<style scoped></style>
