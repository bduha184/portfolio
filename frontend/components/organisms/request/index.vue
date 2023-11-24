<script setup lang="ts">
import { Url } from "~/constants/url";

const messages = ref([]);

const onClick = (id) => {
  return navigateTo(`${Url.REQUESTS}/${id}`);
};

onMounted(async () => {
  const dist = "join";
  const res = await useApiFetch(`/api/message/${dist}`);
  // console.log(res.data.value);
  messages.value.push(...res.data.value.messages);
});
</script>
<template>
  <v-container>
    <AtomsTextsHeadLine> チーム活動内容 </AtomsTextsHeadLine>
    <v-card-text>
      {{ activities }}
    </v-card-text>
  </v-container>
</template>

<style lang="scss" scoped>
.v-list-item {
  & + & {
    margin-top: 0.5rem;
  }
}
</style>
