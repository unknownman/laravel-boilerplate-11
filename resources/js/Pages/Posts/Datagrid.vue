<template>
    <div class="container mx-auto p-10">
        <UiDatagrid :options="options" :data="data" />
    </div>
</template>

<script setup>
defineOptions({
    layout: AuthenticatedLayout
})

const props = defineProps({
    data: [Object, Array]
})

const options = reactive({
    title: "لیست پست ها",
    columns: {
        title: "عنوان",
        comments_no: "نظرات",
        author: "نویسنده"
    },
    actions: {
        edit: {
            title: "ویرایش",
            route: "posts.edit"
        }
    }
})
</script>

<style scoped>

</style>
