<template>
  <textarea
    class="shadow appearance-none border min-h-[150px] rounded w-full p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    :label="props.label"
    @blur="submit"
    :placeholder="props.placeholder"
    :value="props.body"
  >
  </textarea>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const props = defineProps<Props>();
const emits = defineEmits<Emits>();

const submit = (e: Event) => {
  emits("emitInput", e.target as HTMLInputElement);
};
</script>
