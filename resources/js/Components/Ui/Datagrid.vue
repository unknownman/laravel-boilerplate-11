<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg" dir="rtl">
    <h1 class="font-bold text-2xl pb-4 px-4 tracking-tighter">{{ options.title }}</h1>
    <div class="pb-4 bg-white dark:bg-gray-900 py-10 px-5">
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative mt-1">
        <div
          class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none"
        >
          <svg
            class="w-4 h-4 text-gray-500 dark:text-gray-400"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
            />
          </svg>
        </div>
        <input
          type="text"
          v-model="filter"
          id="table-search"
          class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Search for items"
        />
      </div>
    </div>
    <table
      class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    >
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="p-4">
            <div class="flex items-center">
              <input
                id="checkbox-all-search"
                type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label for="checkbox-all-search" class="sr-only">checkbox</label>
            </div>
          </th>
          <th scope="col" v-for="(column, key) in options.columns" class="px-6 py-3">
            {{ column }}
          </th>
          <th scope="col" class="px-6 py-3">عملیات</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-if="data && data.data"
          v-for="(item, key) in data.data"
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
        >
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input
                id="checkbox-table-search-1"
                type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
            </div>
          </td>

          <td v-for="(column, key) in options.columns" class="px-6 py-4">
            <slot
              v-if="slots[`column${key[0].toUpperCase() + key.slice(1).toLowerCase()}`]"
              :name="`column${key[0].toUpperCase() + key.slice(1).toLowerCase()}`"
              :data="item"
            />
            <p v-else>{{ item[key] }}</p>
          </td>
          <td class="px-6 py-4 flex flex-row gap-2">
            <Link
              v-for="(action, key) in options.actions"
              :href="route(action.route, { id: item.id })"
              class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
              ><span
                v-if="action && action.icon"
                v-html="action.icon"
                class="w-8 h-8"
              />{{ action.title }}
            </Link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- pagination links, meta -->
  <div class="flex flex-col items-center pt-5">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
      صفحه <span class="font-semibold text-gray-900 dark:text-white"></span>
      <span class="font-semibold text-gray-900 dark:text-white">{{
        data.meta.current_page
      }}</span>
      از
      <span class="font-semibold text-gray-900 dark:text-white">{{
        data.meta.last_page
      }}</span>
    </span>
    <div class="inline-flex mt-2 xs:mt-0">
      <!-- Buttons -->
      <Link
        :href="data.links.prev"
        v-if="data.links.prev"
        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <svg
          class="w-3.5 h-3.5 me-2 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M13 5H1m0 0 4 4M1 5l4-4"
          />
        </svg>
        قبلی
      </Link>
      <Link
        :href="data.links.next"
        v-if="data.links.next"
        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        بعدی
        <svg
          class="w-3.5 h-3.5 ms-2 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 14 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M1 5h12m0 0L9 1m4 4L9 9"
          />
        </svg>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { useUrlSearchParams, watchDebounced } from "@vueuse/core";
import { router } from "@inertiajs/vue3";
import { useSlots } from "vue";
const props = defineProps({
  options: Object,
  data: [Array, Object],
});

const filter = ref("");
const slots = useSlots();
watchDebounced(
  filter,
  () => {
    const params = useUrlSearchParams("history");
    params.filter = filter.value;
    router.visit(`/${props.options.routeKey}/datagrid?` + objectToUrlParams(params));
  },
  { debounce: 500, maxWait: 1000 }
);

function objectToUrlParams(obj) {
  const params = [];

  for (const key in obj) {
    params.push(`${encodeURIComponent(key)}=${encodeURIComponent(obj[key])}`);
  }

  return params.join("&");
}
</script>

<style scoped></style>
