<template>
  <v-tab :value="val">
    <Icon :name="icon" />
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
