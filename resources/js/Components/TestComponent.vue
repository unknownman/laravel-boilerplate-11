<template>
    <div>
        <h1>{{ title }}</h1>
        <p><slot /></p>
    </div>

</template>
<script setup>
import { defineProps } from 'vue';
const props = defineProps({
    title: String,
})
</script>
<style scoped>
div {
    border:1px solid #ccc;
    border-radius: 10px;
    margin:20px;
}
h1 {
    font-size:larger;
    border-bottom:2px solid #ccc;
    padding:7px;
    background:#eee;
    border-radius: 10px 10px 0 0;
}
p {
    font-size: medium;
    padding:20px;
}
</style>
