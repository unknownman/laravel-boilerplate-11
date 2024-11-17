<template>
    <div>

    </div>
</template>

<script setup>
const echo = window.Echo
echo.channel("chat").listenToAll((e,data) => {
    console.log("new event", e, data);
})
</script>

<style  scoped>

</style>
