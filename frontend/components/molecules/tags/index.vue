<template>
  <v-combobox
    v-model="chips"
    :items="props.items"
    chips
    multiple
    label="タグを選択 or 入力"
  >
    <template v-slot:selection="{ attrs, item, select, selected }">
      <v-chip
        v-bind="attrs"
        :model-value="selected"
        closable
        @click="select"
        @click:close="remove(item)"
      >
        <strong>{{ item }}</strong
        >
        <span>(interest)</span>
      </v-chip>
    </template>
  </v-combobox>
</template>

<script setup lang="ts">
import type { Emits,Props} from "~/types";

const props =defineProps<Props>();
const chips = ref<Array<string>>([]);

function remove(item) {
  chips.value.splice(chips.value.indexOf(item), 1);
}

const emits = defineEmits<Emits>();

watch(()=>chips.value,()=>{
  emits('emitTags',chips.value)
});
watch(()=>props.tags,()=>{
  chips.value=props.tags;
});
</script>
