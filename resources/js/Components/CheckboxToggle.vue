<template>
    <label :for="id" class="flex relative items-center mt-2 cursor-pointer">
        <input type="checkbox" :id="id" v-model="model"  class="sr-only">
        <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
            {{modelValue ? "TAK" : "NIE"}}
        </span>
    </label>
</template>

<script>
import { uuid } from 'vue-uuid';

export default {
    name: "CheckboxToggle",
    props: {
        modelValue: Boolean
    },
    emits: ['update:modelValue'],
    computed: {
      model: {
          get() { return this.modelValue},
          set(newValue) { this.$emit('update:modelValue', newValue)}
      }
    },
    data() {
      return {
          id: uuid.v1(),
      }
    }
}
</script>

<style scoped>

</style>
