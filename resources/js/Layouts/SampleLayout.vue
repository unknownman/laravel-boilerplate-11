<template>
    <div class="bg-gray-100  border-2 flex flex-row">
        <div class="w-32 text-white p-5  bg-red-500 min-h-screen">
            Sidebar
        </div>
        <div class="grow bg-blue text-white">
            <slot />
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>
