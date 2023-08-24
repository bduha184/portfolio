<template>
     <v-tabs
        v-model="tab"
        fixed-tabs
        class="text-center mb-4"
        slider-color="red"
      >
        <AtomsTabsBeforeLogin
        val="register"
        :icon="Icons.REGISTER"
        >
        新規登録
      </AtomsTabsBeforeLogin>
      <AtomsTabsBeforeLogin
      val="login"
      :icon="Icons.LOGIN"
        >
      ログイン
      </AtomsTabsBeforeLogin>
      </v-tabs>
</template>
<script setup>
  import {Icons} from '../../../constants/icons';
import {ref} from 'vue';

  const tab = ref(null);



</script>
