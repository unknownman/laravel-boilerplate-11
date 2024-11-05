<template>
    <div class="grid grid-cols-1 gap-4">
        <h1 class="font-bold">{{ post.title }}</h1>
        <p>{{ post.content }}</p>
        <ul>
            <li v-for="tag in post.tags" :key="tag.id">
                <Link :href="`/tags/${tag.id}`">{{ tag.name }}</Link>
            </li>
        </ul>
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
