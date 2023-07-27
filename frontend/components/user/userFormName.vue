<template>
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-1">
      ユーザーネーム<span class="text-red text-caption">※</span>
    </label>
    <Field
      name="password"
      type="password"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    />
    <span class="text-caption">※20文字以内</span>
    <ErrorMessage class="text-red" name="password" />
  </div>
</template>
<script setup lang="ts">
import {  Field, ErrorMessage } from 'vee-validate'

</script>
