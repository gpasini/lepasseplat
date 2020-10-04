<template>
  <div class="border-gray-200 rounded border m-1" >
      <img width="100 %" v-if="meal.photo" :src="`/storage/${meal.photo}`" />
      <div class="px-4 my-4">
        <div class="font-bold text-lg">
          {{ meal.title }}
        </div>

        <div class="text-gray-500" v-if="meal.description">
            {{ meal.description }}
        </div>
        <div class="text-right font-bold text-lg">
            {{ meal.price }} €
        </div>
        <div v-if="meal.file" class="text-right">
            <a class="underline text-gray-400 text-sm text-right italic" :href="`/storage/${meal.file}`" target="_blank">Fichier</a>
        </div>

        <slot name="actions"></slot>
      </div>
  </div>
</template>

<script>
export default {
  props: {
    meal: {
      type: Object,
      required: true,
    }
  }
}
</script>
