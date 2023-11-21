<template>
  <v-app>
    <AtomsDisplayFlashMessage/>
    <OrganismsGalleryModal/>
    <OrganismsHeaderTheHeader/>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
    <OrganismsFooterTheFooter />
  </v-app>
</template>
