<template>
  <v-app>
    <OrganismsMessagesFlashMessage/>
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
