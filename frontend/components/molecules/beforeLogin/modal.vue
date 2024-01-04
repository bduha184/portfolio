<template>
  <div>
    <v-dialog
      v-model="dialog"
      max-width="600px"
      :class="auth.isLoggedIn ? 'none' : ''"
    >
      <template v-slot:activator="{ props }">
        <AtomsBtnsBaseBtn
          v-bind="props"
          @click="requestJoinTeam"
          :color="props.color"
        >
          <slot />
        </AtomsBtnsBaseBtn>
      </template>
      <v-card class="py-5 px-3">
        <v-card-text class="text-red"
          >※こちらの機能はログイン後にご利用いただけます。
        </v-card-text>
        <v-card-actions class="mx-auto">
          <v-row>
            <v-col>
              <AtomsBtnsBaseBtn @click="dialog = false">
                戻る
              </AtomsBtnsBaseBtn>
            </v-col>
            <v-col>
              <AtomsBtnsBaseBtn width="10rem" color="orange" @click="onClick">
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
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";
import { useAuthStore } from "~/stores/useAuthStore";
import { Url } from "~/constants/url";

const props = defineProps<Props>();
const auth = useAuthStore();
const dialog = ref(false);

const onClick = () => {
  return navigateTo(Url.SIGNIN);
};

const emits = defineEmits<Emits>();

const requestJoinTeam = (e: Event) => {
  emits("emitClick", e.target as HTMLElement);
};
</script>

<style lang="scss" scoped>
ol {
  list-style: decimal;
}

.v-overlay.none {
  display: none;
}
</style>
