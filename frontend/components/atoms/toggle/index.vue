<template>
  <div class="toggle" @click="onClick" :class="props.toggle ? 'open' : ''">
    <span></span>
    <span></span>
    <span></span>
  </div>
</template>

<script setup lang="ts">
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const props = defineProps<Props>();
const emits = defineEmits<Emits>();
const onClick = (e: Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>

<style scoped lang="scss">
.toggle {
  width: 1.6rem;
  height: 1.2rem;
  position: relative;
  z-index: 0;

  &::before {
    content: "";
    display: block;
    width: 3rem;
    height: 3rem;
    border: 1px solid #000;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 100%;
    transition: 0.3s;
  }

  & span {
    display: block;
    width: 100%;
    height: 2px;
    background: #000;
    position: absolute;
    left: 0;
    z-index: 0;
    transition: 0.3s;
    &:nth-of-type(1) {
      top: 0;
    }
    &:nth-of-type(2) {
      top: 50%;
      transform: translateY(-50%);
    }
    &:nth-of-type(3) {
      bottom: 0;
    }
  }

  &.open {
    &::before {
      border-radius: 0;
      width: 2.5rem;
      height: 2.5rem;
    }
    & span {
      &:nth-of-type(1) {
        top: 50%;
        transform: translateY(-50%) rotate(315deg);
      }
      &:nth-of-type(2) {
        opacity: 0;
        visibility: hidden;
      }
      &:nth-of-type(3) {
        bottom: 50%;
        transform: translateY(50%) rotate(-315deg);
      }
    }
  }
}
</style>
