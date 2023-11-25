<template>
  <v-container class="bg-white">
    <MoleculesBeforeLoginTabs v-model="tab"/>
    <v-window v-model="tab">
      <v-window-item value="register">
        <OrganismsBeforeLoginSignUp/>
      </v-window-item>
      <v-window-item value="login">
        <OrganismsBeforeLoginSignIn/>
      </v-window-item>
    </v-window>

  </v-container>
</template>


<script setup lang="ts">

const router = useRoute();
const param = router.query.tab;

const tab = ref(param);

</script>
