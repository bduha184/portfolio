<template>
    <div class="bg-white text-center py-4 text-caption">
      &copy;{{ year }}<NuxtLink :to="Url.TOP">Circle Community</NuxtLink>
    </div>
</template>

<script setup lang="ts">
import {Url} from "~/constants/url";

const date = new Date();
const year = date.getFullYear();

</script>
