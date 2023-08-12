<template>
  <div>
    <TitleHeadline title="募集チーム数"/>
    ：<span class="text-red pr-1">{{ count }}</span>件
  </div>
</template>

<script setup lang="ts">

import {ref} from 'vue';

const count =ref(0);
</script>
