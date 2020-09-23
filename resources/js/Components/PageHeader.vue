<template>
  <div :class="padding" class="header text-center">
      <h2 :class="textSize" class="font-semibold text-white leading-tight">
          {{ title }}
      </h2>
      <h3 v-if="subtitle" class="text-white text-sm">
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

  computed: {
    padding() {
      if (this.size === 'medium') {
        return ['pb-40 pt-64']
      }

      if (this.size === 'small') {
        return ['py-10'];
      }

      return [];
    },
    textSize() {
      if (this.size === 'medium') {
        return ['text-5xl']
      }

      if (this.size === 'small') {
        return ['text-3xl'];
      }

      return [];
    }
  }
}
</script>

<style>
.header {
    background: url(/img/bg1.jpeg);
    background-size: cover;
    background-position: center;
}
</style>
