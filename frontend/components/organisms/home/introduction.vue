<template>
    <v-container max-width="1000px">
      <OrganismsHomeSectionTitle
   title="ABOUT"
   subTitle="このアプリについて"
   />
      <v-row>
        <v-col cols="12" sm="6">
          <div>
            <p>
              CycleCommunityは、 一緒に走るメンバーを募集したり、
              愛車を紹介したり、 ルートを投稿・検索したり ブログを投稿したり,
              様々な機能を集約した、自転車好き、サイクリング好きのためのコミュニティサイトです。
            </p>
            <ButtonCommon
            btnValue="さっそく始める"
            place="SIGNIN"
            width="16rem"
            class="mt-4 d-none d-sm-block"
            />
            <ButtonCommon
            btnValue="ゲストユーザーとしてログイン"
            place="MAIN"
            setColor="orange"
            width="16rem"
            class="mt-4 d-none d-sm-block"
            />
          </div>
        </v-col >
        <v-col cols="12" sm="6">
          <v-img
            contain
          :src="`${config.public.appURL}/images/hero-main.webp`"
          >
          </v-img>
          <ButtonCommon
            btnValue="さっそく始める"
            place="SIGNIN"
            width="16rem"
            class="mt-4 d-block d-sm-none"
            />
            <ButtonCommon
            btnValue="ゲストユーザーとしてログイン"
            place="guest"
            setColor="orange"
            width="16rem"
            class="mt-4 d-block d-sm-none"
            />

        </v-col>
      </v-row>
    </v-container>
</template>

<script setup lang="ts">
const config = useRuntimeConfig();

</script>
