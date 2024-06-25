<template>
    <div class="flex h-screen  flex-col place-content-center place-items-center">
        <h1 class="text-2xl">صفحه لیست پست ها</h1>
        <p class="text-lg text-slate-400">این صفحه لیست پست ها را نشان می دهد</p>
        <ul>
            <li>
                <Link href="/post/1">
                صفحه اول
                </Link>
            </li>
            <li>
                <Link href="/post/2">
                صفحه دوم
                </Link>
            </li>
            <li>
                <Link href="/post/3/">
                صفحه سوم
                </Link>
            </li>
        </ul>
    </div>
</template>

<script setup>

</script>

<style  scoped>

</style>
