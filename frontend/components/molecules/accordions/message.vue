<template>
  <v-container
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
      :setColor="setColor"
      >
       {{ text }}
       </AtomsBtnsBaseBtn>
    </div>
    </transition>
  </v-container>
</template>

<script setup lang="ts">
import {ref,computed} from 'vue';
const props = defineProps({
  toggle: {
    type: String,
    default: false,
  },
  setColor:{
    type:String,
    default:''
  },
  placeholder:{
    type:String,
    default:''
  },
  text:{
    type:String,
    default:''
  },
});

const form = ref();

const receiveBody = (val) => {
  form.value = val.value
}

const checkFilledOut = computed(() => {
  const field = form.value;

  if(field) {
    return true;
  }else{
    return false;
  }

});


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
