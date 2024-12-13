<template>
    <div>
        <form @submit.prevent="form.post(`/post/${post.id}/comment`)" class="grid grid-cols-1 gap-2 ">

            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نظر شما</label>

            <textarea id="body" rows="4" v-model="form.body"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :class="{
                    'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500'
                : form.errors.body}"
                placeholder=" نظر خود را اینجا بنویسید..."></textarea>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ارسال
                نظر</button>

        </form>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3"
const props = defineProps({
    post: Object
})

const form = useForm({
    body: ""
})
</script>

<style  scoped>

</style>
