<template>
  <div>
    <input
      name="name"
      :type="type"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
      @blur="submit"
      :value="val"
    />
  </div>
</template>

<script setup lang="ts">
import {ref} from 'vue';
// import {inject} from 'vue';
// const type = inject('type');

const props = defineProps({
  type:{
    type:String,
    default:''
  },
  val:{
    type:String,
    default:''
  }
})

const emit = defineEmits(['emitInput']);

const submit = (e) => {
  emit('emitInput',e.target.value);
}

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
    transform: translate(-50%,-50%);
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
      transform:translate(-80%,-40%) rotate(45deg);
    }
  }
}
</style>
