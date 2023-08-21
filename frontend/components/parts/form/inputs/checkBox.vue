<template>
  <input
    type="checkbox"
    :class="{ active: checked }"
    v-model="checked"
    @click="onChange"
  />
</template>

<script setup>
const props = defineProps({
  value:{
    type:Boolean,
    default:false
  }
})
const emits = defineEmits(["check"]);

const checked = ref(props.value);

const onChange = () => {
  checked.value = checked.value ? false : true;
  emits("check", checked.value);
};
</script>


<style lang="scss" scoped>
input[type="checkbox"] {
  appearance: none;
  position: relative;

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
      top: -5px;
      left: 5px;
      border-radius: 0;
      opacity: 1;
      border-top-color: transparent;
      border-left-color: transparent;
      transform:translate(-80%,-40%) rotate(45deg);
    }
  }
}
</style>
