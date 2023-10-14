<template>
  <OrganismsMessagesDetail/>
</template>
<script setup lang="ts">
import {definePageMeta} from '#imports';
import {Url} from '../../../../constants/url';
import { useAuthStore } from '../../../../stores/useAuthStore';

definePageMeta({
  middleware: ["auth"]
})

const auth = useAuthStore();

const handleLogout = async()=> {
  await auth.logout();

}

</script>
