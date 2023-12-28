<template>
  <section class="hero">
    <img
    class="hero-bg"
    :src="`${config.public.appURL}/images/mainvisual2.jpg`"
    />
    <div class="btn-wrap">
    </div>
  </section>
</template>

<script setup lang="ts">
import {Url} from "~/constants/url";

const config = useRuntimeConfig();

const handleRegister = () => {
  navigateTo(Url.SIGNUP);
}

const handleLogin = () => {

}

</script>

<style scoped lang="scss">
  .hero {
    position:relative;
    z-index:0;
    // padding: 5%;
    &-bg{
      // position:absolute;
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

    & .btn-wrap {
      position: absolute;
      bottom: 10%;
      left: 10%;
    }
  }
</style>
