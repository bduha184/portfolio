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
import {useRoute,computed,ref} from "#imports";
const router = useRoute();

const page = ref<string | null>();

const path = computed(()=> {
  if(router.path == '/') page.value = 'top';
  return router.path;
})

</script>

<style scoped lang="scss">
.v-main{
  margin-top: 1rem;
  &.top{
    margin-top: 0 !important;

  }
}
</style>
