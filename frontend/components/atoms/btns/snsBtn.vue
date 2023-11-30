<template>
  <v-btn
    variant="outlined"
    rounded="0"
    @click="onClick"
  >
    <slot/>
  </v-btn>
</template>

<script setup lang="ts">
import type { Emits} from "~/types";

const emits = defineEmits<Emits>();

const onClick = (e:Event) => {
  emits('emitClick',e.target as HTMLElement);
}

</script>
