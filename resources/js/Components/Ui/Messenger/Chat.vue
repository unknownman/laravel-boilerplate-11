<template>
  <div id="chat">
    <header>
      {{ user.name }}
    </header>
    <section>
      <div id="messageContainer">
        <div v-for="m in messages" id="conversation">
          <div v-if="m.from_id == currentUser.id" class="from">
            {{ m.text }}
          </div>

          <div v-else class="to">
            {{ m.text }}
          </div>
        </div>
      </div>
      <small v-if="isTyping">{{ user.name }} در حال نوشتن است ...</small>
    </section>
    <footer>
      <input
        class="input"
        v-model="form.message"
        @keydown="sendTypingEvent"
        @keyup.enter="sendMessage"
      />
      <button @click="sendMessage">ارسال</button>
    </footer>
  </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted } from "vue";
const page = usePage();
const currentUser = page.props.auth.user;
const messages = ref([]);
const isTyping = ref(false);
const isTypingTimer = ref(0);
const props = defineProps({
  user: Object,
});
const form = useForm({
  message: "",
});

async function getMessages(u) {
  await axios.get(`/messenger/${u.id}`).then((response) => {
    messages.value = response.data;
  });
}

function sendMessage() {
  if (form.message.trim() !== "") {
    axios
      .post(`/messenger/${props.user.id}`, {
        message: form.message,
      })
      .then((response) => {
        messages.value.push(response.data);
        form.reset();
      });
  }
}

function sendTypingEvent() {
  window.Echo.private(`chat.${props.user.id}`).whisper("typing", {
    userID: currentUser.id,
  });
}

onMounted(() => {
  getMessages(props.user);
});
watch(
  () => props.user,
  (newUser) => {
    if (newUser && newUser.id) {
      getMessages(newUser);
    }
    window.Echo.private(`chat.${currentUser.id}`)
      .listen("ChatMessage", (response) => {
        messages.value.push(response.message);
      })
      .listenForWhisper("typing", (response) => {
        isTyping.value = response.userID === props.user.id;
        if (isTypingTimer.value) {
          clearTimeout(isTypingTimer);
        }
        isTypingTimer.value = setTimeout(() => {
          isTyping.value = false;
        }, 1000);
      });
  },
  {
    immediate: true,
  }
);
</script>

<style scoped>
div#chat {
  @apply flex flex-col place-content-start flex-grow h-screen overflow-y-auto relative;
}
header {
  @apply h-12 flex flex-col place-items-start place-content-center w-full px-5 py-5  bg-white border-b-2  ps-5 font-black;
}
footer {
  @apply absolute bottom-0 bg-white w-full p-5 h-20 flex flex-row gap-2;
}
footer > .input {
  @apply flex-grow w-full bg-gray-300 py-5 px-3 rounded-xl;
}
section {
  @apply flex-grow mb-[6rem] h-[calc(100%-1300px)] bg-gray-100 overflow-y-auto;
}
small {
  @apply absolute bottom-[70px] w-full h-4  bg-white text-gray-500 text-center z-50;
}
#conversation .from {
  @apply mt-4 mr-2 py-3 px-4 bg-blue-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white max-w-64;
}
#conversation .to {
  @apply mr-2 py-3 px-4 bg-gray-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white self-end max-w-64;
}
#conversation {
  @apply flex flex-col my-5 px-2 container w-full;
}
</style>
