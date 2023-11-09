<template>
    <v-dialog
    max-width="600px"
    persistent
    v-model="dialog"
    hide-overlay
    >
    <!-- v-if="auth.isLoggedIn  ? '' : 'hide-overlay'" -->
      <template v-slot:activator="{ props }">
        <AtomsBtnsBaseBtn
          width="16rem"
          class="my-4 d-block mx-auto"
          v-bind="props"
          :color="color"
          @emitClick="receiveClick(); dialog=false"
        >
          <slot />
        </AtomsBtnsBaseBtn>
      </template>
      <v-card class="py-5 px-3" v-if="checkStatus">
        <v-card-text class="text-red">
          {{ caution }}
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
                :color="color"
                @emitClick="onClick"
              >
                {{ btnValue }}
              </AtomsBtnsBaseBtn>
            </v-col>
          </v-row>
        </v-card-actions>

      </v-card>
    </v-dialog>
</template>

<script setup lang="ts">
import { ref, navigateTo, useRoute, onMounted, computed } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { Url } from "../../../constants/url";

const props = defineProps({
  btnType: {
    type: String,
    default: "",
  },
  color: {
    type: String,
    default: "",
  },
  btnValue: {
    type: String,
    default: "ログイン",
  },
  caution: {
    type: String,
    default: "※こちらの機能はログイン後にご利用いただけます。",
  },
  userId:{
    type:Number,
    default:''
  }
});

const dialog = ref(false);
const auth = useAuthStore();
const router = useRoute();
interface Emits {
  (e: "emitModalBtnClick"): void;
  (e: "emitModalOpen"): void;
  (e: "emitAccordion"): void;
}
const emits = defineEmits<Emits>();
const checkStatus = computed(() => {
  if(auth.isLoggedIn && props.userId == auth.user.id) {
    return dialog.value = true;
  }
  if (auth.isLoggedIn && props.userId != auth.user.id) {
  // if (auth.isLoggedIn && path.indexOf("auth") == -1) {
    return dialog.value = false;
  }
  return dialog.value = true;
  // if (!auth.isLoggedIn || auth.isLoggedIn && path.indexOf("auth") != -1) {
});

const onClick = () => {
  if (!auth.isLoggedIn) {
    return navigateTo({
      path:Url.SIGNIN,
      query:{
        tab:'login'
      }
      })
  } else {

    if (props.btnType == "delete") {
      emits("emitModalBtnClick");
    }
  }
};

const receiveClick = () => {

  if (dialog.value == false) {
    if (auth.isLoggedIn) {
      emits("emitModalOpen");
      emits("emitAccordion");
    } else {
      console.log('true');
      dialog.value = true;
    }
  }
};

</script>
