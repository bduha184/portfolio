<script setup lang="ts">
import { useApiFetch } from "~/composables/useApiFetch";

const config = useRuntimeConfig();
const router = useRoute();

const form = ref({
  path_header: "",
  path_thumbnail: "",
  name: '',
  header_img: "",
  thumbnail: "",
  introduction: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});


onMounted(async () => {
  const userId = router.params.id;
  if (userId) {
    const res = await useApiFetch(`/api/profile/${userId}`);
    const val = res.data.value;
    console.log(val);
    if(val.data != null){
      form.value.url_header_img =
        config.public.baseURL + "/storage/" + val.data.header_img_path;
      form.value.url_thumbnail =
        config.public.baseURL + "/storage/" + val.data.thumbnail_path;
      form.value.introduction = val.data.introduction;
      form.value.name = val.data.name;
      form.value.item_id = val.data.id;
      form.value.name = val.data.user.name;
    }
  }
});
</script>

<template>
  <div>
    <form method="POST">
      <h2 class="text-center text-h5 mb-5">パスワード再設定</h2>
      <p
      class="bg-blue-100 text-center mb-5 p-2 "
      v-show="message"
      >{{ message }}</p>
      <div class="text-caption">
        <span class="text-red">※</span>は必須項目です
      </div>
      <MoleculesInput
        type="email"
        label="メールアドレス"
        @emitInput="receiveEmail"
        :val="form.email"
        class="mb-4"
      />
      <AtomsBtnsBaseBtn
        width="16rem"
        color="info"
        class="my-4 d-block mx-auto"
        :disabled="!checkFilledOut"
        @emitClick="handleSendEmail"
      >
        メール送信
      </AtomsBtnsBaseBtn>

    </form>
  </div>
</template>

<style lang="scss" scoped>
.v-card {
  overflow: hidden !important;
  border-radius: 10px;
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 1;
}

.v-responsive {
  position: unset !important;
}
.v-file-input {
  opacity: 0;
  position: absolute !important;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100%;
  z-index: 10;
  background: red;
}
</style>
