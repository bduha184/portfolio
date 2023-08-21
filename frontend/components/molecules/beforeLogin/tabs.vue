<template>
     <v-tabs
        v-model="tab"
        fixed-tabs
        class="text-center mb-4"
        slider-color="red"
      >
        <PartsTabsBeforeLogin
        value="register"
        :icon="Icons.REGISTER"
        >
        新規登録
      </PartsTabsBeforeLogin>
      <PartsTabsBeforeLogin
      value="login"
      :icon="Icons.LOGIN"
        >
      ログイン
      </PartsTabsBeforeLogin>
      </v-tabs>
</template>
<script setup>
  import {Icons} from '../../../constants/icons';


  const props = defineProps({
    tab:{
      type:String,
      default:false
    }
  })

  const tab = ref(props.tab);

</script>
