<script setup></script>

<template>
  <v-app>
    <AtomsDisplayFlashMessage/>
    <OrganismsGalleryModal/>
    <Header />
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
    <Footer />
  </v-app>
</template>
