<template>
  <div>
    <v-dialog v-model="dialog" max-width="600px" persistent>
      <template v-slot:activator="{ props }">
        <AtomsBtnsBaseBtn
          width="16rem"
          class="my-4 d-block mx-auto"
          v-bind="props"
          :setColor="setColor"
          @emitClick="receiveClick"
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
                {{ btnValue }}
              </AtomsBtnsBaseBtn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup lang="ts">
import { ref, navigateTo, useRoute, onMounted, computed } from "#imports";
import { useAuthStore } from "../../../stores/useAuthStore";
import { Url } from "../../../constants/url";
import { chownSync } from "fs";

const props = defineProps({
  btnType: {
    type: String,
    default: "",
  },
  setColor: {
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
});
const dialog = ref(false);
const auth = useAuthStore();
const router = useRoute();
const path = router.path;

interface Emits {
  (e: "emitModalBtnClick"): void;
  (e: "emitModalOpen"): void;
  (e: "emitAccordion"): void;
}
const emits = defineEmits<Emits>();
const checkStatus = computed(() => {
  if (auth.isLoggedIn && path.indexOf("auth") == -1) {
    return (dialog.value = false);
  }
  if (auth.isLoggedIn && path.indexOf("auth") != -1) {
    return (dialog.value = true);
  }
});

const onClick = () => {
  if (!auth.isLoggedIn) {
    dialog.value = true;
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
      dialog.value = true;
    }
  }
};
</script>