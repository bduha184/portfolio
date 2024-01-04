<template>
  <div>
    <v-btn
      @dragover.prevent="isDragged = true"
      @dragleave.prevent="isDragged = false"
      @drop.prevent="onFileDropped"
      width="100%"
      height="100%"
      color="info"
      class="text-none"
      :variant="!isDragged ? 'contained' : 'outlined'"
      depressed
      @click="openFileSelect"
    >
      <v-progress-circular
        v-if="isSelecting"
        class="mx-12 my-6"
        indeterminate
        color="white"
      />
      <v-row v-if="!isSelecting" class="text-center" justify="center">
        <v-col class="mt-2 mb-n2" cols="10">
          <v-icon size="40">
            {{ props.buttonIcon }}
          </v-icon>
        </v-col>
        <v-col class="text-truncate mb-2 mt-n2" cols="10">
          ファイルを選択<br />
          or<br />
          ドラッグ&ドロップ
        </v-col>
      </v-row>
    </v-btn>
    <input
      ref="uploader"
      class="d-none"
      type="file"
      :accept="props.accept"
      @change="onFileSelectChange"
      multiple
    />
  </div>
</template>

<script setup lang="ts">
import { Icons } from "~/constants/icons";
import { useGalleryStore } from "~/stores/useGalleryStore";
import type { Props } from "~/types/props";
import type { Emits } from "~/types/emits";

const gallery = useGalleryStore();

const props = withDefaults(defineProps<Props>(), {
  buttonTitle: "ファイルを選択",
  buttonIcon: Icons.UPLOAD,
  accept: "image/*",
});

const emits = defineEmits<Emits>();

const isSelecting = ref<boolean>(false);
const isDragged = ref<boolean>(false);

const uploader = ref<HTMLInputElement>();
const openFileSelect = () => {
  isSelecting.value = true;
  window.addEventListener(
    "focus",
    () => {
      isSelecting.value = false;
    },
    { once: true }
  );
  uploader.value?.click();
};

const onFileSelectChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  const files = target.files!;
  // emits("emitImages", {files})
  gallery.setImages(files);
};

const onFileDropped = (e: DragEvent) => {
  isDragged.value = false;
  if (!e || !e.target || e.dataTransfer.files.length === 0) {
    return;
  }
  const files = e.dataTransfer.files;
  gallery.setImages(files);
  // emits("emitImages", {files});
};
</script>
