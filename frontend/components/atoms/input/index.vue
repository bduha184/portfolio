<template>
  <input
    ref="uploader"
    name="name"
    :type="type"
    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    @change="onChange"
    :value="val"
    :placeholder="placeholder"
    multiple
    :disabled="disabled"
  />
</template>

<script setup lang="ts">
import {ref,watch} from '#imports';
const props = defineProps({
type:{
  type:String,
  default:''
},
val:{
  type:[String,Boolean],
  default:''
},
placeholder:{
  type:String,
  default:''
},
accept:{
  type:String,
  default:'text'
},
isSelecting:{
  type:Boolean,
  default:false
},
disabled:{
  type:Boolean,
  default:false
}
})

interface Emits {
(e: "emitInput", value: File): void;
}
const emits = defineEmits<Emits>();

const uploader = ref<HTMLInputElement>();
const selectedFile = ref<File | null>(null)

watch(()=>props.isSelecting,()=>{
if(props.isSelecting){
  uploader.value?.click();
}
});

const onChange = (e: Event) => {
  const target = e.target as HTMLInputElement
  if(props.type==='file'){
    const files = target.files
    const file = files![0]
    selectedFile.value = file
    emits("emitInput", file)
  }else{
    emits('emitInput',target)
  }
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
