<template>
  <textarea
    class="shadow appearance-none border min-h-[150px] rounded w-full p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    :label="label"
    @blur="submit"
    :placeholder="placeholder"
    :value="body"
  >
  </textarea>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

defineProps<Props>();
const emits = defineEmits<Emits>();

const submit = (e: Event) => {
  emits("emitInput", e.target as HTMLInputElement);
};
</script>
