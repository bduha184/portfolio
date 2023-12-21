<template>
  <v-btn
    rounded="xl"
    density="compact"
    :height="props.height"
    :to="props.to"
    :color="props.color"
    @click="onClick"
    :variant="props.variant"
    :disabled="props.disabled"
    :prepend-icon="props.prependIcon"
  >
    <slot />
  </v-btn>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const props = withDefaults(defineProps<Props>(), {
  variant: "elevated",
  height: 40,
});

const emits = defineEmits<Emits>();

const onClick = (e: Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>
