<template>
  <v-dialog
    max-width="600px"
    class="m-0"
    :persistent="persistent"
    v-model="dialog"
    hide-overlay
  >
    <template v-slot:activator="{ props }">
      <AtomsBtnsBaseBtn
        width="16rem"
        class="my-4 d-block mx-auto"
        :disabled="disabled"
        v-bind="props"
        :color="color"
        @emitClick="
          receiveClick();
          dialog = false;
        "
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
            <AtomsBtnsBaseBtn @click="dialog = false"> 戻る </AtomsBtnsBaseBtn>
          </v-col>
          <v-col>
            <AtomsBtnsBaseBtn width="10rem" :color="color" @emitClick="onClick">
              {{ buttonValue }}
            </AtomsBtnsBaseBtn>
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>

    <v-card class="py-5 px-3" v-else>
      <v-card-actions class="w-100 d-block mx-auto text-center">
        <AtomsTextAreas
          :placeholder="placeholder"
          @emitInput="receiveBody"
          :body="form"
        />
        <AtomsBtnsBaseBtn
          :disabled="checkFilledOut"
          :color="color"
          @emitClick="sendMessage"
          width="16rem"
          class="my-4 d-block mx-auto"
        >
          {{ text }}
        </AtomsBtnsBaseBtn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import { Url } from "~/constants/url";
import type {Props} from "~/types/props";
import type {Emits} from "~/types/emits";


const props = withDefaults(defineProps<Props>(),{
  caution:'※こちらの機能はログイン後にご利用いただけます。',
  buttonType:'ログイン',
  persistent:false,
  disabled:false
})

const dialog = ref(false);
const auth = useAuthStore();
const router = useRoute();
const messages = ref();
const emits = defineEmits<Emits>();

const form = ref();

const checkStatus = computed(() => {
  if (!auth.isLoggedIn) return true;
  if (auth.isLoggedIn && router.path.indexOf("auth") != -1) return true;
  if (auth.isLoggedIn && props.userId == auth.user?.id) return true;
  return false;
});

const onClick = () => {
  if (!auth.isLoggedIn) {
    return navigateTo({
      path: Url.SIGNIN,
      query: {
        tab: "login",
      },
    });
  } else {
    if (props.buttonType == "delete") {
      emits("emitModalBtnClick");
    }
  }
};

const receiveBody = (val) => {
  return (messages.value = val.value);
};

const checkFilledOut = computed(() => {
  if (messages.value) return false;
  return true;
});

const receiveClick = () => {
    emits("emitModalOpen");
  };
  const sendMessage = () => {
    emits("emitMessages",messages.value);
}

</script>
