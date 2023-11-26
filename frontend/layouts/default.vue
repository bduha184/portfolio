<template>
  <v-app>
    <OrganismsMessagesFlashMessage/>
    <OrganismsHeaderTheHeader/>
    <v-main>
      <v-content>
        <slot />
      </v-content>
    </v-main>
    <OrganismsFooterTheFooter />
    <OrganismsGalleryModal/>
  </v-app>
</template>
