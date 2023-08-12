<template>
  <v-card height="100px" class="relative z-0">
    <v-img
      src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
      cover
    >
    <v-avatar
    size="80"
    >
      <v-img
        src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
        cover
      >
      </v-img>
    </v-avatar>

    </v-img>
  </v-card>
</template>

<style lang="scss" scoped>
.v-card {
  overflow:visible !important;
}
  .v-avatar {
    position:absolute !important;
    bottom:-40px;
    left:20px;
    z-index: 10;
  }

  .v-responsive {
  position: unset !important;
}
</style>
