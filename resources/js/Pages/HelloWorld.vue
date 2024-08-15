<template>
  <div>
    <div class="bg-blue-200 text-indigo-600 font-bold text-xl">This is a Test</div>
    <h1>Hello world</h1>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum porro voluptate
      reiciendis quas! Quae, est? Aut pariatur repudiandae error unde minus temporibus,
      libero nobis ab! Hic aperiam et magni. Modi.
    </p>

    <p>The Counter is : {{ count }}</p>
    <button @click="onClickHandle">Increase!</button>

    <div>
      <p v-if="color == 'red'">The Color is Red and the message is :`{{ myMessage }}`</p>
      <p v-else>The Color isn't Red and the message is :`{{ myMessage }}`</p>
    </div>

    <div>
      <TestComponent title="this is title">
        <ApplicationLogo />
      </TestComponent>
    </div>
  </div>
</template>

<script setup>
defineOptions({ layout: SampleLayout });
const { count, myMessage, onClickHandle, color } = useTest();
</script>

<style scoped>
h1 {
  padding: 1em;
  padding-bottom: 0;
  font-size: x-large;
  color: #999;
}
p {
  padding: 2em;
  font-size: medium;
  color: #444;
}
button {
  background: #eee;
  color: #333;
  padding: 1em;
}
.red {
  background: red;
  color: white;
}
</style>
