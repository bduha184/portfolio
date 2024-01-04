<template>
  <v-card @click="onClick" min-height="300px">
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
        <div class="d-flex align-center">
          <AtomsIcons :name="Icons.CYCLING" class="border-none" :size=25 />:
          <v-list-item-title class="pl-2">
            {{ props.member }}人
          </v-list-item-title>
        </div>
      </v-list-item>
      <v-list-item min-height="unset" class="py-0">
        <div class="d-flex align-center overflow-x-scroll">
          <AtomsIcons :name="Icons.MAP" class="border-none" :size=25 />:
          <v-list-item-title
            class="pl-2"
            v-for="(area, i) in props.areas"
            :key="i"
          >
          <span  v-if="i >0">,</span>
          {{ area.name }}
        </v-list-item-title>
      </div>
    </v-list-item>
    <v-list-item min-height="unset" class="py-0">
      <div class="d-flex align-center">
        <AtomsIcons :name="Icons.SCHEDULE" class="border-none" :size=25 /> :
        <v-list-item-title
        class="pl-2"
        v-for="(day,i) in props.days"
        :key="i"
        >
        <span  v-if="i >0">,</span>
            {{ day.name }}
          </v-list-item-title>
        </div>
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
import type { Props } from "~/types/props";

const props = defineProps<Props>();

const config = useRuntimeConfig();

const onClick = () => {
  if (props.auth) {
    return navigateTo(Url.AFFILIATION + "/" + props.id);
  }
  return navigateTo({
    path: Url.TEAMS + "/" + props.id,
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

.v-list{
  &:deep(.v-list-item__content ){
    overflow:unset !important;

  }
}
.v-chip {
  min-width: fit-content;
  &-group {
    flex-wrap: nowrap;
  }
}
</style>
~/types/props
