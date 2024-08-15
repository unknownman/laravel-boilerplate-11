<template>
  <LayoutWrapper>
    <LayoutHeader />
    <LayoutContainer>
      <LayoutMain>
        <slot />
      </LayoutMain>
      <LayoutAside />
    </LayoutContainer>
    <LayoutFooter />
  </LayoutWrapper>
</template>

<script setup></script>

<style scoped></style>
