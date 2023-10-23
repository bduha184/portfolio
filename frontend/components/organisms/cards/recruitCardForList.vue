<template>
  <v-card @click="onClick" min-height="300px">
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
    <v-list>
        <v-list-item
        min-height="unset"
        class="py-0"
        >
          <v-list-item-content
          class="d-flex align-center"
          >
            <AtomsIcons
            :name="Icons.CYCLING"
            class="border-none"
            size="25"
            />:
            <v-list-item-title
            class="pl-2"
            >
             {{ profiles.length + 1 }}人
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item
        min-height="unset"
        class="py-0"
        >
          <v-list-item-content
          class="d-flex align-center"
          >
            <AtomsIcons
            :name="Icons.MAP"
            class="border-none"
            size="25"
            />:
            <v-list-item-title
            class="pl-2"
            v-for="(area,i) in areas"
            :key="i"
            >
          {{ area.name }},
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item
        min-height="unset"
        class="py-0"
        >
          <v-list-item-content
          class="d-flex align-center"
          >
            <AtomsIcons
            :name="Icons.SCHEDULE"
            class="border-none"
            size="25"
            /> :
            <v-list-item-title
            class="pl-2"
            >
          {{ date_time }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
  <v-chip-group
  class="px-2"
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
import { Url } from "@/constants/url";
import {Icons} from "@/constants/icons";

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
  profiles: {
    type: Array,
    default: [],
  },
  date_time: {
    type: String,
    default: '',
  },
  areas: {
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
  &-group{
    flex-wrap: nowrap;
  }
}
</style>
