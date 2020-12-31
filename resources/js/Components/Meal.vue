<template>
  <div class="m-1" >
      <div>
        <img class="h-40 object-cover" width="100%" v-if="meal.photo" :src="`/storage/${meal.photo}`" />
      </div>
      <div class="my-4">
        <div class="font-bold text-sm text-center">
          {{ meal.title }}
        </div>

        <div class="font-bold text-md text-center">
            {{ meal.price }} €
        </div>

        <div class="text-gray-500 leading-tight text-sm" v-if="meal.description && displayDescription">
            <div>{{ meal.description }}</div>
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
