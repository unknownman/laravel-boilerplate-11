<template>
  <div class="container mx-auto p-10">
    <UiDatagrid :options="options" :data="data">
      <template #columnStatus="{ data }">
        <button
          @click="changeStatus(data)"
          v-if="data.status == 'approved'"
          class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
        >
          تاییده شده
        </button>
        <button
          @click="changeStatus(data)"
          v-else-if="data.status == 'unapproved'"
          class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300"
        >
          تاییده شده
        </button>
        <button
          @click="changeStatus(data)"
          v-else="data.status == ''"
          class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300"
        >
          نامعلوم
        </button>
      </template>
    </UiDatagrid>
  </div>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';

defineOptions({
  layout: AuthenticatedLayout,
});

const props = defineProps({
  data: [Object, Array],
});

const form = useForm({
    id: ""
})

function changeStatus(data) {
    form.id = data.id
    form.post("/comments/status", {
        preserveScroll: true,
        onSuccess: () => {
            router.reload({only: ['data']})
            form.reset();
        }
    })
}

const options = reactive({
  title: "لیست نظرات",
  columns: {
    email: "نویسنده",
    body: "متن پیام",
    status: "وضعیت",
  },
  actions: {
    trash: {
      route: "comments.trash",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-400 " viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79s-2.196.81-4.856.81h-.774c-2.66 0-3.991 0-4.856-.81c-.865-.809-.954-2.136-1.13-4.79l-.46-6.9M9.5 11l.5 5m4.5-5l-.5 5"/><path d="M6.5 6h.11a2 2 0 0 0 1.83-1.32l.034-.103l.097-.291c.083-.249.125-.373.18-.479a1.5 1.5 0 0 1 1.094-.788C9.962 3 10.093 3 10.355 3h3.29c.262 0 .393 0 .51.019a1.5 1.5 0 0 1 1.094.788c.055.106.097.23.18.479l.097.291A2 2 0 0 0 17.5 6"/></g></svg>`,
    },
    delete: {
      route: "comments.delete",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-700" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.402 6.506M4.5 5.5l.605 10.025c.154 2.567.232 3.85.874 4.774c.317.456.726.842 1.2 1.131c.671.41 1.502.533 2.821.57m10-7l-7 7m7 0l-7-7M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5" color="currentColor"/></svg>`,
    },
  },
  routeKey: "comments",
});
</script>

<style scoped></style>
