<template>
    <header >
        <div>
            <h1>مگ مگ</h1>
            <button @click="onToggle()">
                <IconNav class="w-8 h-8 fill-slate-700" />
            </button>
        </div>
        <nav :class="[{'close': !isOpen}]">
            <ul>
                <li>
                    <Link href="/">خانه</Link>
                </li>
                <li>
                    <Link href="/posts">پست ها</Link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script setup>
const isOpen = ref(false)
function onToggle() {
    isOpen.value = !isOpen.value
}
</script>

<style  scoped>
header {
    @apply flex flex-col md:flex-row md:justify-between
}
header > div {
    @apply flex flex-row justify-between
}
header h1 {
    @apply text-3xl font-bold p-5
}
header button {
    @apply md:hidden
}
nav {
    @apply flex flex-col gap-4 bg-slate-900 text-white p-5 md:grow
}
nav ul {
    @apply md:flex md:flex-row md:gap-4
}
nav.close {
    @apply hidden md:block
}
</style>
