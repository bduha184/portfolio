<template>
  <div>
    <label class="block text-gray-700 text-sm font-bold mb-2">
      メールアドレス
    </label>
    <Field
      name="email"
      type="text"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    />
    <ErrorMessage class="text-red" name="email" />
  </div>
</template>
<script setup lang="ts">
import {  Field, ErrorMessage } from 'vee-validate'

</script>
