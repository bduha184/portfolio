<template>
  <form>
    <div class="relative z-0 h-[100px]">
      <AtomsImgsCardHeaderImg
        @emitInput="receiveImg"
        :path="recruitItems.url_header_img"
      >
        <AtomsImgsThumbnail
          @emitInput="receiveThumbnail"
          :path="recruitItems.url_thumbnail"
        />
      </AtomsImgsCardHeaderImg>
    </div>
    <v-card-title class="w-60 text-body-2 text-left ml-auto">
      <AtomsInput
        class="pl-2 leading-snug relative before:absolute before:left-0 before:top-0 before:h-full before:w-[3px] before:bg-orange-600 z-100"
        placeholder="チーム名"
        type="text"
        @emitInput="receiveTeamName"
        :val="recruitItems.title"
      />
    </v-card-title>
    <v-card-text>
      <AtomsTextAreas
        placeholder="本文"
        @emitInput="receiveTeamIntroduce"
        :body="recruitItems.text"
      />
    </v-card-text>
    <v-container>
      <AtomsDecorationHeadline>
        ギャラリー
      </AtomsDecorationHeadline>
      <OrganismsDrugAndDrop
      @emitImages="receiveImages"
      />
      <OrganismsGallery
      :images="images"
      @emitClick="receiveClick"
      />
    </v-container>
    <AtomsBtnsBaseBtn
      width="16rem"
      class="my-4 d-block mx-auto"
      @click="handleRegister"
      :disabled="!checkFilledOut()"
      v-if="!recruitItems.item_id"
    >
      登録
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="orange"
      class="my-4 d-block mx-auto"
      @click="handleUpdate"
      :disabled="!checkFilledOut()"
      v-if="recruitItems.item_id"
    >
      更新
    </AtomsBtnsBaseBtn>
    <AtomsBtnsBaseBtn
      width="16rem"
      setColor="red"
      class="my-4 d-block mx-auto"
      @click="handleDelete"
      v-if="recruitItems.item_id"
    >
      削除
    </AtomsBtnsBaseBtn>
  </form>
</template>

<script setup lang="ts">
import { useRuntimeConfig, navigateTo,useRoute, clearNuxtData } from "nuxt/app";
import { useApiFetch } from "~/composables/useApiFetch";
import { ref, onMounted,computed } from "vue";
import { Url } from "~/constants/url";
import { useAuthStore } from "~/stores/useAuthStore";
// import { useRoute } from "vue-router";

const auth = useAuthStore();
const router = useRoute();

const config = useRuntimeConfig();

const images = ref({
  name:[],
  path:[]
});

const recruitItems = ref({
  items: [],
  item: "",
  itemCount: 0,
  path_header: "",
  path_thumbnail: "",
  item_id: "",
  user_id: "",
  header_img: "",
  thumbnail: "",
  title: "",
  text: "",
  url_header_img: config.public.appURL + "/images/noimage.jpg",
  url_thumbnail: config.public.appURL + "/images/noimage.jpg",
});

const handleRegister = async () => {
  const formData = new FormData();
  const imageData = new FormData();

  formData.append("header_img", recruitItems.value.header_img);
  formData.append("thumbnail", recruitItems.value.thumbnail);
  formData.append("title", recruitItems.value.title);
  formData.append("text", recruitItems.value.text);

  images.value.forEach((image,i)=>{
    imageData.append('image_path',image);Ú
  })

  await useApiFetch("/sanctum/csrf-cookie");
  const res = await useApiFetch("/api/recruit/register", {
    method: "POST",
    body: formData,
  });
  const resImage = await useApiFetch("/api/images/register",{
    method: "POST",
    body: ImageData,
  })

  console.log('formData',res);
  console.log('imageData',resImage);
  recruitItems.value.item_id = res.data.value.itemId;
  recruitItems.value.path_header = res.data.value.path_header;
  recruitItems.value.path_thumbnail = res.data.value.path_thumbnail;

  return navigateTo({
    path: Url.AUTHRECRUIT,
    query: {
      id: recruitItems.value.item_id,
    },
  });
};
const handleUpdate = async () => {
  const formData = new FormData();

  formData.append("header_img", recruitItems.value.header_img);
  formData.append("thumbnail", recruitItems.value.thumbnail);
  formData.append("title", recruitItems.value.title);
  formData.append("text", recruitItems.value.text);

  await useApiFetch("/sanctum/csrf-cookie");

  const res = await useApiFetch(`/api/recruit/${recruitItems.value.item_id}`, {
    method: "POST",
    body: formData,
    headers: {
      "X-HTTP-Method-Override": "PUT",
    },
  });

  // console.log(res);
  recruitItems.value.path_header = res.data.value.path_header;
  recruitItems.value.path_thumbnail = res.data.value.path_thumbnail;
};

const handleDelete = async () => {
  await useApiFetch("/sanctum/csrf-cookie");
  await useApiFetch(`/api/recruit/${recruitItems.value.item_id}`, {
    method: "DELETE",
    key:'deleteItem',
  });

  return navigateTo({
    path:Url.AUTHRECRUIT,
  });
};

const checkFilledOut = () => {
  const fieldArray = [recruitItems.value.title, recruitItems.value.text];

  if (fieldArray.indexOf("") === -1) {
    return true;
  }

  return false;
};


const receiveImages = (val)=> {
  Array.from(val).map((data)=>{
   let image = window.URL.createObjectURL(data);
   images.value.push(image);
  })
}

const receiveClick = (val)=> {
  // console.log(val);
  images.value.splice(val,1);
}

const receiveImg = (val) => {
  recruitItems.value.header_img = val.files[0];
  recruitItems.value.url_header_img = URL.createObjectURL(
    recruitItems.value.header_img
  );
  URL.revokeObjectURL(recruitItems.value.header_img);
};

const receiveThumbnail = (val) => {
  recruitItems.value.thumbnail = val.files[0];
  recruitItems.value.url_thumbnail = URL.createObjectURL(
    recruitItems.value.thumbnail
    );
    URL.revokeObjectURL(recruitItems.value.thumbnail);
};
const receiveTeamName = (val) => {
  recruitItems.value.title = val.value;
};
const receiveTeamIntroduce = (val) => {
  recruitItems.value.text = val.value;
};

onMounted(async () => {
  const itemId=router.query.id;
  if(itemId){
    const res = await useApiFetch(`/api/recruit/${itemId}`);
    const val = res.data.value;
    console.log(res.data);
    recruitItems.value.item_id = val.data.id;
    recruitItems.value.url_header_img =config.public.baseURL + "/storage/" + val.data.header_img_path;
    recruitItems.value.url_thumbnail =config.public.baseURL + "/storage/" + val.data.thumbnail_path;
    recruitItems.value.title = val.data.title;
    recruitItems.value.text = val.data.text;
    recruitItems.value.user_id = val.data.user_id;
  }

});
</script>

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
