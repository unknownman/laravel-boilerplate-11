<template>
    <div class="h-screen w-screen flex flex-col place-content-center place-items-center">
        <h1>صفحه پست {{ id }}</h1>
        <p>صفحه پست {{ id }}, {{ slug }}</p>
        <Link href="/posts">بازگشت به لیست پست ها</Link>

    </div>
</template>

<script setup>
const props = defineProps({
    id: String,
    slug: String
})

</script>

<style  scoped>

</style>
