<template>
  <footer>
    <div class="meta">
      <h1>مگ مگ</h1>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore aliquam,
        blanditiis saepe dolore facere laborum rem fugit quidem odit suscipit maiores
        voluptatum quo eius quod non obcaecati, est accusantium a?
      </p>
    </div>
    <nav>
      <ul>
        <li>
          <Link href="/">خانه</Link>
        </li>
        <li>
          <Link href="/posts">پست ها</Link>
        </li>
      </ul>
    </nav>
  </footer>
</template>
<style scoped>
footer {
  @apply bg-slate-900 text-gray-100 flex flex-col md:flex-row md:justify-between gap-8 p-8;
}
footer h1 {
  @apply text-xl;
}
footer .meta {
  @apply w-full md:w-1/3;
}
footer nav {
  @apply w-full md:w-2/3;
}
</style>
