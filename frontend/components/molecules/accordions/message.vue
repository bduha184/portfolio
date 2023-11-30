<template>
  <div
  class="overflow-hidden"
  >
  <transition>
    <div
    v-show="toggle"
    >
      <AtomsTextAreas
      :placeholder="placeholder"
      @emitInput="receiveBody"
      :body="form"
      />
      <AtomsBtnsBaseBtn
      :disabled="!checkFilledOut"
      :color="color"
      @emitClick="receiveClick"
      >
       {{ text }}
       </AtomsBtnsBaseBtn>
    </div>
    </transition>
  </div>
</template>

<script setup lang="ts">
import type { Emits,Props} from "~/types";

const props = withDefaults(defineProps<Props>(),{
  toggle:false,
});

const form = ref();

const checkFilledOut = computed(() => {
  const field = form.value;

  if(!field) return false;

  return true;

});

const emits=defineEmits<Emits>();

const receiveBody=(val:string)=> {
  form.value = val.value;
  emits('emitInput',form.value);
}

const receiveClick=(e:Event)=> {
  emits('emitClick',e.target as HTMLElement);
}

</script>

<style lang="scss" scoped>
.v-container {
  overflow: hidden;
}
.v-enter-to {
  transition: transform 0.3s  ease-out;
  transform: translateY(0px);
}
.v-enter-from {
  transform: translateY(-100%);
}

.v-leave-to {
  transition: transform 0.3s  ease-out;
  transform: translateY(-100%);
}
.v-leave-from {
  opacity: 1;
  transform: translateY(0px);
}
</style>
