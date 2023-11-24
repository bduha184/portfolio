<script setup lang="ts">
import type { Emits,Props} from "~/types";
import { Icons } from "~/constants/icons";

const props = defineProps<Props>();
const emits = defineEmits<Emits>();

const onClick = (e:Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>

<template>
  <v-btn
    variant="text"
    :icon="Icons.NAVI"
    height="40"
    width="40"
    :color="color"
    class="text-h4 text-decoration-none rotate-90"
    @click="onClick"
    :disabled="disabled"
  />
</template>
