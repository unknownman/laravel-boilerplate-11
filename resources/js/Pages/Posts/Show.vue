<template>
  <div class="grid grid-cols-1 gap-4">
    <h1 class="font-bold">{{ post.title }}</h1>
    <p>{{ post.content }}</p>
    <ui-comment-list :comments="post.comments" />
    <form-comment :post="post" />
    <Link href="/posts">بازگشت به لیست پست ها</Link>
  </div>
</template>

<script setup>

const props = defineProps({
  id: String,
  slug: String,
  post: Object,
});
defineOptions({
    layout: DefaultLayout
})
</script>

<style scoped></style>
