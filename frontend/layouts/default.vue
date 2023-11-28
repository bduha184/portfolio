<template>
  <v-app>
    <OrganismsMessagesFlashMessage/>
    <OrganismsHeaderTheHeader
    :page="page"
    />
    <v-main
    :class="`${path}` == '/' ? 'top' : ''"
    >
      <v-content>
        <slot />
      </v-content>
    </v-main>
    <OrganismsFooterTheFooter />
    <OrganismsGalleryModal/>
  </v-app>
</template>

<script setup lang="ts">
const router = useRoute();

const page = ref<string | null>();

const path = computed(()=> {
  if(router.path == '/') page.value = 'top';
  return router.path;
})

</script>

<style scoped lang="scss">
.v-main{
  padding-left: 1rem;
  padding-right: 1rem;
  max-width: 600px;
  width: 100%;
  margin: 1rem auto 0;
  @include display_pc(md){
    .v-container {
      max-width: 200px !important;
    }
  }
  &.top{
    margin-top: 0 !important;
    padding-left: 0;
    padding-right: 0;
    max-width: initial !important;
    @mixin display_pc{
      // .v-container {
      //   max-width: ;
      // }
    }

  }
}
</style>
