<template>
  <v-tab
  :value="val"
  >
    <AtomsIcons
    class="d-block mx-auto"
    :name="icon"
    size="50"
    padding="p-2"
    />
      <slot />
  </v-tab>
</template>

<script setup>
const props = defineProps({
  val: {
    type: String,
    default: "",
  },
  icon: {
    type: String,
    default: "",
  },
});

</script>

<style scoped lang="scss">
.v-btn {

  padding: 0.5rem !important;

  &:deep(.v-btn__content){
    display: block;
  }
}
</style>
