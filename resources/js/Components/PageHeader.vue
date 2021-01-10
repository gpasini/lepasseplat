<template>
  <div :class="padding" class="header text-center sm:pb-24 sm:pt-40 py-10">
      <h2 :class="textSize" class="font-semibold text-white leading-tight sm:text-6xl text-3xl">
          {{ title }}
      </h2>
      <h3 v-if="subtitle" class="text-white text-xl">
          {{ subtitle }}
      </h3>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    subtitle: {
      type: String,
      default: null,
    },
    size: {
      type: String,
      default: 'medium',
    }
  },
}
</script>

<style>
.header {
    background: url(/img/bg1.jpeg);
    background-size: cover;
    background-position: center;
}
</style>
