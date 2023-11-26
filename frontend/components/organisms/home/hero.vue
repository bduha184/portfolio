<template>
  <section class="hero">
    <img
    class="hero-bg"
    :src="`${config.public.appURL}/_nuxt/assets/images/mainvisual.jpg`"
    />
    <img
    class="hero-main"
    :src="`${config.public.appURL}/_nuxt/assets/images/hero-main.webp`"
    />
  </section>
</template>

<script setup>
const config = useRuntimeConfig();
</script>

<style scoped lang="scss">
  .hero {
    position:relative;
    z-index:0;
    padding: 5%;
    &-bg{
      position:absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
      top: 0;
      left: 0;
    }

    &-main {
      width: 100%;
      height: 100%;
      max-width: 800px;
      margin: 0 auto;
      opacity: 0.5;
    }
  }
</style>
