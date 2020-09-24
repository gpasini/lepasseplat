<template>
  <div class="border m-2 p-2" >
      <img width="100" v-if="meal.photo" :src="`/storage/${meal.photo}`" />

      <div>
          {{ meal.title }}
      </div>

      <div>
          {{ meal.description }}
      </div>
      <div>
          {{ meal.price }} €
      </div>

      <slot name="actions"></slot>
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
