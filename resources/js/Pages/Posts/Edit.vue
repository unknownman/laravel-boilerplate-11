<template>
    <div class="p-10">
        <form @submit.prevent="form.put('/posts/'+post.id)">
            <ui-input label="عنوان" :error="form.errors.title" v-model="form.title" />
            <ui-input label="نامک" :error="form.errors.slug" v-model="form.slug" />
            <ui-textarea label="توضیحات" :error="form.errors.description" v-model="form.description" />
            <ui-editor label="متن" :error="form.errors.content" v-model="form.content" />
            <button class="btn" type="submit">ارسال</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    post: Object
})
const form = useForm({
    title: props.post.title,
    description: props.post.description,
    content: props.post.content,
    slug: props.post.slug
})


</script>

<style  scoped>

</style>
