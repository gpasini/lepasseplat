<template>
  <div class="border-gray-200 rounded border m-1" >
      <div>
        <img class="h-40 object-cover" width="100%" v-if="meal.photo" :src="`/storage/${meal.photo}`" />
      </div>
      <div class="px-4 my-4">
        <div class="font-bold text-lg text-center">
          {{ meal.title }}
        </div>

        <div class="text-gray-500 leading-tight h-24" v-if="meal.description && displayDescription">
            <div class="h-full">{{ meal.description }}</div>
        </div>
        <div class="font-bold text-lg text-center">
            {{ meal.price }} €
        </div>
        <div v-if="meal.file && displayFile">
            <a class="underline text-gray-500 text-sm block text-center italic" :href="`/storage/${meal.file}`" target="_blank">Allergènes</a>
        </div>

        <div v-else>
          <br>
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
    },
    displayDescription: {
      type: Boolean,
      default: true
    },
    displayFile: {
      type: Boolean,
      default: true
    }
  }
}
</script>
