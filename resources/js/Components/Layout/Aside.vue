<template>
  <aside class="aside">
    <div class="aside-content">
      <h2 class="aside-title">پربازدیدترین پست‌ها</h2>
      <ul class="aside-links ">
        <li v-for="post in topPostsByViews" :key="post.id">
          <Link :href="`/post/${post.id}/${post.slug}`" class="aside-link group">
            <span class="icon group-hover:grayscale-0 group-hover:animate-ping">🔥</span> {{ post.title }}
          </Link>
        </li>
      </ul>

      <h2 class="aside-title">پرلایک‌ترین پست‌ها</h2>
      <ul class="aside-links ">
        <li v-for="post in topPostsByLikes" :key="post.id">
          <ui-link :href="`/post/${post.id}/${post.slug}`" class="aside-link group">
            <span class="icon group-hover:grayscale-0 group-hover:animate-ping">❤️</span> {{ post.title }}
          </ui-link>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const topPostsByViews = ref([]);
const topPostsByLikes = ref([]);

const fetchTopPosts = async () => {
  try {
    const response = await axios.get("/posts/top-posts");
    topPostsByViews.value = response.data.topPostsByViews;
    topPostsByLikes.value = response.data.topPostsByLikes;
    console.log(response)
  } catch (error) {
    console.error("خطا در دریافت پست‌ها:", error);
  }
};

onMounted(fetchTopPosts);
</script>

<style scoped>
.aside {
  @apply w-full max-w-md min-w-[400px]  mx-auto p-4 bg-white rounded-3xl shadow-2xl shadow-indigo-100;
}

.aside-content {
  @apply p-6   rounded-xl bg-gradient-to-b from-white via-indigo-500/10 to-white;
}

.aside-title {
  @apply  text-xl border-r-8  rounded-r-[30px]   -ms-4 -me-10  h-20 flex flex-col place-content-center   font-semibold mb-4 text-white  ps-5 bg-gradient-to-br from-slate-800 via-indigo-700 to-gray-500 shadow-inner shadow-2xl shadow-gray-500/70   tracking-tighter;
}
.aside-links {
  @apply list-none p-0 m-0 mb-20;
}

.aside-link {
  @apply  flex cursor-pointer items-center p-3 mb-2 text-gray-800 rounded-lg transition-all duration-300 ease-in-out transform hover:bg-teal-50 hover:translate-x-1 hover:shadow-xl hover:shadow-teal-50;
}
.aside-link:active {
  @apply translate-x-0 shadow-md ;
}

.icon {
  @apply text-sm grayscale-[0.75]   me-3 text-red-500;
}

@media (max-width: 640px) {
  .aside {
    @apply max-w-full p-2;
  }

  .aside-title {
    @apply text-lg;
  }

  .aside-link {
    @apply text-sm p-2;
  }
}
</style>
