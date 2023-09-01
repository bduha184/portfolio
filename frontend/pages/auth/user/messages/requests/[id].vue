<template>
  <div>
    {{ $route.params.id }}
  </div>
</template>

<script setup lang="ts">
import { useRoute } from "nuxt/app";
import { onMounted, ref } from "vue";

const messages = ref([]);
const router = useRoute();

// onMounted(async () => {
//   messages.value.length = 0;
//   const res = await useApiFetch(`/api/message/${router.params.id}`);
//   console.log(res.data.value);
//   messages.value.push(...res.data.value);
// });
</script>
