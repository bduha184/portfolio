<template>
  <v-card @click="onClick" height="300px">
    <OrganismsImgsCardProfile
      :path_header="config.public.baseURL + '/storage/' + header_img_path"
      :path_thumbnail="config.public.baseURL + '/storage/' + thumbnail_path"
      :disabled="true"
    />

    <v-card-title class="text-body-2">
      <AtomsTextsHeadLine>
        {{ team_name }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ introduction }}
    </v-card-text>
  <v-chip-group
  class="absolute bottom-0 px-2"
  >
    <v-chip
    v-for="(tag, i) in tags" :key="i"
    class="text-caption"
    >
    {{ tag.name }}
      </v-chip>
    </v-chip-group>
  </v-card>
</template>

<script setup lang="ts">
import { useRuntimeConfig } from "nuxt/app";
import { navigateTo } from "nuxt/app";
import { Url } from "../../../constants/url";

const props = defineProps({
  header_img_path: {
    type: String,
    default: "",
  },
  thumbnail_path: {
    type: String,
    default: "",
  },
  team_name: {
    type: String,
    default: "",
  },
  introduction: {
    type: String,
    default: "",
  },
  id: {
    type: Number,
    default: "",
  },
  tags: {
    type: Array,
    default: [],
  },
});
const config = useRuntimeConfig();

const onClick = () => {
  return navigateTo(Url.TEAMS + "/" + props.id);
};
</script>

<style lang="scss" scoped>
.v-card {
  position: relative;
  & + & {
    margin-top: 1rem;
  }
}
.v-avatar {
  position: absolute !important;
  bottom: -40px;
  left: 20px;
  z-index: 10;
}

.v-responsive {
  position: unset !important;
}

.v-chip {
  min-width:fit-content;
}
</style>
