<template>
  <v-container>
    <v-row>
      <v-col cols="12" sm="6">
        <div>
          <p>
            CycleCommunityは、 一緒に走るメンバーを募集したり、
            愛車を紹介したり、 ルートを投稿・検索したり ブログを投稿したり,
            様々な機能を集約した、自転車好き、サイクリング好きのためのコミュニティサイトです。
          </p>
          <Btn
          btnValue="さっそく始める"
          place="LOGIN"
          width="16rem"
          class="mt-4 d-none d-sm-block"
          />
          <Btn
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
          src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
          contain
        >
        </v-img>
        <Btn
          btnValue="さっそく始める"
          place="LOGIN"
          width="16rem"
          class="mt-4 d-block d-sm-none"
          />
          <Btn
          btnValue="ゲストユーザーとしてログイン"
          place="MAIN"
          setColor="orange"
          width="16rem"
          class="mt-4 d-block d-sm-none"
          />

      </v-col>
    </v-row>
    <!-- <div class="d-md-block">
    </div> -->
  </v-container>
</template>
