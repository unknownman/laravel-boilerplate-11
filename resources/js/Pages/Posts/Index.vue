<template>
    <div class="grid grid-cols-1 gap-4">
        <Link v-for="post in posts" :href="`/post/${post.id}/${post.slug}`">
            <h1 class="font-bold">{{ post.title }}</h1>
            <p>{{ post.description }}</p>
        </Link>
    </div>
</template>

<script setup>
const props = defineProps({
    posts:Array
})
</script>

<style  scoped>

</style>
