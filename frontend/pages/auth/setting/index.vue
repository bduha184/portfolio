<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
          <AtomsIconsSquare
          :name="Icons.DASHBOARD"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
          />
          各種設定
        </h6>
    </v-container>
    <v-container
    class="bg-white text-center"
    >
      <!-- <v-row class="text-center py-4">
        <v-col cols="6"
        v-for="(menu,i) in AuthSettingMenus"
        :key="i"
        >
        <div
        @click="onClick(menu.flg)"
        >
          <AtomsIcons
              class="d-block mx-auto"
              :name="menu.icon"
              size="70"
              padding="p-2"
            />
            {{ menu.text }}
        </div>
      </v-col> -->

    <!-- </v-row> -->
    <OrganismsModal
  @emitModalBtnClick="handleDelete"
  color="red"
  caution="※退会しますとデータが完全に削除され戻せなくなります。退会しますか？"
  buttonValue="退会する"
  buttonType="delete"
>
退会
</OrganismsModal>
    </v-container>
  </div>
</template>

<script setup lang="ts">
import {Icons} from "~/constants/icons";
import { useFlashMessageStore } from "~/stores/useFlashMessageStore";
import { useAuthStore } from "~/stores/useAuthStore";
import {Message} from "~/constants/flashMessage";
import {Url} from "~/constants/url";

const flashMessage = useFlashMessageStore();

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleDelete = async () => {
 const res =  await auth.deleteUser()
    if (res.error.value != null) {
      return flashMessage.setMessage(Message.LOGINERROR,'error',6000);
    }
    flashMessage.setMessage(Message.DELETE);
    return navigateTo(Url.TOP);

};

</script>
