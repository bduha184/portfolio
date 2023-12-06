<template>
  <v-card @click="onClick(auth)" min-height="300px">
    <OrganismsImgsCardProfile
      :pathHeader="config.public.baseURL + '/storage/' + props.headerImgPath"
      :pathThumbnail="config.public.baseURL + '/storage/' + props.thumbnailPath"
      :disabled="true"
    />

    <v-card-title class="text-body-2">
      <AtomsTextsHeadLine>
        {{ props.teamName }}
      </AtomsTextsHeadLine>
    </v-card-title>
    <v-card-text>
      {{ props.introduction }}
    </v-card-text>
    <v-list>
      <v-list-item min-height="unset" class="py-0">
        <v-list-item-content class="d-flex align-center">
          <AtomsIcons :name="Icons.CYCLING" class="border-none" size="25" />:
          <v-list-item-title class="pl-2">
            {{ props.member }}人
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item min-height="unset" class="py-0">
        <v-list-item-content class="d-flex align-center">
          <AtomsIcons :name="Icons.MAP" class="border-none" size="25" />:
          <v-list-item-title
            class="pl-2"
            v-for="(area, i) in props.areas"
            :key="i"
          >
            {{ area.name }},
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item min-height="unset" class="py-0">
        <v-list-item-content class="d-flex align-center">
          <AtomsIcons :name="Icons.SCHEDULE" class="border-none" size="25" /> :
          <v-list-item-title class="pl-2">
            {{ props.activeDate }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <v-chip-group class="px-2">
      <v-chip v-for="(ride, i) in props.rides" :key="i" class="text-caption">
        {{ ride.name }}
      </v-chip>
    </v-chip-group>
  </v-card>
</template>

<script setup lang="ts">
import { Url } from "~/constants/url";
import { Icons } from "~/constants/icons";
import type { Props } from "~/types";

const props = defineProps<Props>();
// const props = defineProps<{
//   teamName: Props;
//   introduction: Props;
//   member: Props;
//   areas: Props;
//   activeDate: Props;
//   tags: Props;
// }>();



const config = useRuntimeConfig();

const onClick = (auth) => {
  if (auth) {
    return navigateTo(Url.AFFILIATION + "/" + props.id);
  }
  return navigateTo({
    path: Url.TEAMS + "/" + props.id,
    // query: {
    //   user: props.profiles.user_id,
    // },
  });
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
  min-width: fit-content;
  &-group {
    flex-wrap: nowrap;
  }
}
</style>
~/types/types ~/types/types
