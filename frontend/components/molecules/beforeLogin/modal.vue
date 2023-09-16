<template>
  <div>
    <v-dialog v-model="dialog" max-width="600px"
    :class="auth.isLoggedIn ? 'none' : ''"
    >
      <template v-slot:activator="{ props }">
        <AtomsBtnsBaseBtn
        v-bind="props"
        @click="requestJoinTeam"
        :setColor="setColor"
        >
              <slot/>
          </AtomsBtnsBaseBtn>
      </template>
      <v-card class="py-5 px-3"
      >
       <v-card-text class="text-red">※こちらの機能はログイン後にご利用いただけます。
       </v-card-text>
        <v-card-actions class="mx-auto">
          <v-row>
            <v-col>
              <AtomsBtnsBaseBtn
              @click="dialog = false"
              >
                戻る
              </AtomsBtnsBaseBtn>
            </v-col>
            <v-col>
              <AtomsBtnsBaseBtn
              width="10rem"
              setColor="orange"
              @click="onClick"
              >
                ログイン
              </AtomsBtnsBaseBtn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useAuthStore } from "../../../stores/useAuthStore";
import { navigateTo } from "nuxt/app";
import {Url} from '../../../constants/url';

const props = defineProps({
  toggle:{
    type:Boolean,
    default:false
  },
  setColor :{
 type:String,
 default:''
  }
})
const auth = useAuthStore();
const dialog = ref(false);

const onClick = () => {
  return navigateTo(Url.SIGNIN)
}

const emits = defineEmits(['emitClick']);

const requestJoinTeam = () => {
  emits('emitClick');
}

</script>

<style lang="scss" scoped>
ol {
  list-style: decimal;
}

.v-overlay.none {
  display: none;
}


</style>
