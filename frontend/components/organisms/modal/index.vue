
<template>
  <div>
    <v-dialog
      v-model="dialog"
      max-width="600px"
      persistent
    >
      <template v-slot:activator="{ props }">
        <AtomsBtnsBaseBtn
        width="16rem"
        class="my-4 d-block mx-auto"
          v-bind="props"
          :setColor="setColor"
        >
          <slot />
        </AtomsBtnsBaseBtn>
      </template>
      <v-card
        class="py-5 px-3">
        <v-card-text class="text-red">
          {{ caution }}
        </v-card-text>
        <v-card-actions class="mx-auto">
          <v-row>
            <v-col>
              <AtomsBtnsBaseBtn @click="dialog = false">
                戻る
              </AtomsBtnsBaseBtn>
            </v-col>
            <v-col>
              <AtomsBtnsBaseBtn
                width="10rem"
                setColor="orange"
                @click="onClick"
              >
                {{btnValue}}
              </AtomsBtnsBaseBtn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>
    {{ dialog }}
  </div>
</template>

<script setup lang="ts">
import { ref,navigateTo,useRoute,onBeforeMount } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { Url } from "../../../constants/url";

const props = defineProps({
  btnType:{
    type:String,
    default:''
  },
  setColor: {
    type: String,
    default: "",
  },
  btnValue:{
    type:String,
    default:'ログイン'
  },
  caution:{
    type:String,
    default:'※こちらの機能はログイン後にご利用いただけます。'
  }
});
const dialog = ref(false);
const auth = useAuthStore();
const router = useRoute();


interface Emits {
  (e: "emitClick"): void;
}
const emits = defineEmits<Emits>();
const onClick = () => {

  if(props.btnType == 'delete'){
    emits("emitClick");
  }
  if(!auth.isLoggedIn){
    return navigateTo(Url.SIGNIN);
  }

};

onBeforeMount(()=>{
  if(auth.isLoggedIn && router.path.indexOf('auth') == -1){

    dialog.value = false;
  }
})

</script>
