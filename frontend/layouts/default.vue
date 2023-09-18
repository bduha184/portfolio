<script setup></script>

<template>
  <v-app>
    <Header />
      <v-main>
        <v-container>
    <slot />

  </v-container>
    </v-main>
    <Footer/>

  </v-app>
</template>
