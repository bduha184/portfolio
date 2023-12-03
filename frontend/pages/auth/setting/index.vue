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
      <v-row class="text-center py-4">
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
      </v-col>

    </v-row>
    <!-- <OrganismsModal
  @emitModalBtnClick="handleDelete"
  color="red"
  caution="※退会しますとデータが完全に削除され戻せなくなります。退会しますか？"
  btnValue="退会する"
  btnType="delete"
>
退会
</OrganismsModal> -->
      <AtomsBtnsBaseBtn
        width="10rem"
        color="info"
        :prependIcon="Icons.BACK"
        variant="outlined"
        class="my-4 text-center pr-8"
        @click="router.go(-1)"
      >
        戻る
      </AtomsBtnsBaseBtn>
    </v-container>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from "~/stores/useAuthStore";
import {AuthSettingMenus} from "~/constants/menuItems";
import {Icons} from "~/constants/icons";
import {Message} from "~/constants/flashMessage";
import {useFlashMessageStore} from "~/store/useFlashMessageStore";

definePageMeta({
  middleware: ["auth"]
})
const auth = useAuthStore();
const flashMessage = useFlashMessageStore();
const router = useRouter();


const onClick = (flg) => {
  // if(flg==0) {

  // }
}

const handleDelete = () => {
  const res = auth.deleteUser();
  if(res.error == null){
    return flashMessage.setMessage(Message.WITHDRAW);
  }
  return flashMessage.setMessage(Message.WITHDRAWERROR,'error',6000);

}


</script>
