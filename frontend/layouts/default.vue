<script setup></script>

<template>
  <v-app>
    <AtomsDisplayFlashMessage/>
    <Header />
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
    <Footer />
  </v-app>
</template>
