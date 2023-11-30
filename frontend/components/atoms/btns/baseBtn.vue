<template>
  <v-btn
    rounded="xl"
    density="compact"
    :height="height"
    :to="to"
    :color="color"
    @click="onClick"
    :variant="variant"
    :disabled="disabled"
    :prepend-icon="prependIcon"
  >
    <slot />
  </v-btn>
</template>

<script setup lang="ts">
import type { Emits,Props} from "~/types";

const props = withDefaults(defineProps<Props>(),{
  variant: 'elevated',
  height: 40,
})

const emits = defineEmits<Emits>();

const onClick = (e:Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>
