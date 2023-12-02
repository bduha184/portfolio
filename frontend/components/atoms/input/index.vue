<template>
  <input
    multiple
    ref="uploader"
    :accept="accept"
    :disabled="disabled"
    :name="name"
    :placeholder="placeholder"
    :type="type"
    :value="val"
    @change="onChange"
    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
  />
</template>


<script setup lang="ts">
import type { Emits} from "~/types";
import {watch } from "#imports";

interface Props {
  accept:string;
  disabled:boolean;
  name:string;
  placeholder:string;
  type:string;
  val:string;
  isSelecting:boolean;
}


const props = withDefaults(defineProps<Props>(), {
  type: "text",
  isSelecting: false,
  disabled: false,
});
console.log(props.isSelecting);
const emits = defineEmits<Emits>();
const uploader = ref<HTMLInputElement>();
const selectedFile = ref<File | string | null>(null);

watch(
  () => props.isSelecting,
  () => {
    if (props.isSelecting) {
      uploader.value?.click();
    }
  }
);

const onChange = (e: Event) => {

  const target = e.target as HTMLInputElement | File;
  if (props.type === "file") {
    const files = target.files;
    const file = files![0];
    selectedFile.value = file;
    emits("emitInput", file);
  } else {
    emits("emitInput", target);
  }
};
</script>

<style lang="scss" scoped>
input[type="checkbox"] {
  appearance: none;
  position: relative;
  box-shadow: none;
  border: none !important;

  &::before {
    content: "";
    display: block;
    width: 20px;
    height: 20px;
    border: 2px solid #0104b7;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.6;
    -webkit-transition: all 0.12s, border-color 0.08s;
    transition: all 0.12s, border-color 0.08s;
  }

  &:checked {
    &::before {
      width: 10px;
      top: 5px;
      left: 15px;
      border-radius: 0;
      opacity: 1;
      border-top-color: transparent;
      border-left-color: transparent;
      transform: translate(-80%, -40%) rotate(45deg);
    }
  }
}
</style>
