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
<style scoped>
header {
  @apply flex flex-col md:flex-row md:justify-between bg-gradient-to-tr from-indigo-700 to-indigo-900 text-white p-8 rounded-b-3xl shadow-2xl shadow-indigo-900/50;
}
header > div {
  @apply flex flex-row justify-between items-center;
}
header h1 {
  @apply text-4xl font-extrabold text-white;
}
header button {
  @apply md:hidden p-2 bg-slate-800 rounded-full hover:bg-slate-700 transition-all duration-300 ease-in-out;
}
nav {
  @apply flex flex-col gap-6 p-6 md:grow  rounded-xl ;
}
nav ul {
  @apply md:flex md:flex-row md:gap-8;
}
nav.close {
  @apply hidden md:block;
}
nav li a {
  @apply text-white hover:text-indigo-400 transition-all duration-300 ease-in-out;
}
</style>
