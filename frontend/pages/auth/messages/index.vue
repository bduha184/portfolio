<script setup lang="ts">
import {definePageMeta,useRouter} from '#imports';
import {Url} from '../../../constants/url';
import { useAuthStore } from '../../../stores/useAuthStore';
import {Icons} from '~/constants/icons';

definePageMeta({
  middleware: ["auth"]
})
const router = useRouter();

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>

<template>
  <div>
    <v-container class="bg-white mb-2">
      <h6 class="text-h6">
          <AtomsIconsSquare
          :name="Icons.MESSAGES"
          color="white"
          class="bg-red p-3 rounded"
          size="50"
          />
          受信メッセージ一覧
        </h6>
        <p>
          <span class="font-weight-bold text-decoration-underline">
            {{auth.user.name}}
          </span>さんの受信メッセージ一覧ページです
        </p>
    </v-container>
    <v-container class="bg-white text-center">
      <OrganismsMessages/>
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
